<?php
    namespace App\Controllers;

    use App\Models\User;
    use App\Models\Ngo;
    use App\Models\State;
    use App\Models\City;
    use App\Models\Payment;

    class Ngos extends BaseController
    {
        protected $helpers = ["custom"];

        public function __construct()
        {
            $session = session();
            $this->userdata = $session->get('userdata');
        }

        public function index(): string
        {
            if(isset($this->userdata['id'])){
                $model = new Ngo;
                $data["pgs"] = $model->where('created_by',$this->userdata['id'])->orderBy('id',"desc")->get()->getResultArray();

                return view("admin/ngo/list",$data);
            } else {
                return redirect("auth");
            }
        }

        public function new()
        {
            $session = session();
            if($session->get("userdata")){
                $data["ngo"] = array();

                $model = new State;
                $data["states"] = $model->select("id,name")->orderBy("name","asc")->get()->getResultArray();

                return view("admin/ngo/add_edit",$data);
            } else {
                return redirect("/");
            }
        }

        public function create()
        {
            $session = session();
            $post = $this->request->getVar();

            $post['created_by'] = $this->userdata['id'];
            $post['updated_by'] = 0;
            $post['created_at'] = date('Y-m-d H:i:s');
            $post['updated_at'] = "0000-00-00 00:00:00";
            $model = new Ngo;
            if($model->insert($post)) {
                $ngo_id = $model->getInsertID();

                if($_FILES['banner']['name'] != "") {
                    $file = $this->request->getFile("banner");
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    $banner = "banner_".$file->getRandomName(); 
                    $file->move("public/uploads/ngo/", $banner);

                    $model = new Ngo;
                    $model->update($ngo_id,array("banner" => $banner));

                    // if($post["old_qrcode"] != "" && file_exists("public/uploads/qrcode/".$post["old_qrcode"]))
                    //     unlink("public/uploads/qrcode/".$post["old_qrcode"]);
                }

                $photos = [];
                $total = count($_FILES['photos']['name']);
                for($i = 0; $i < $total; $i++)
                {
                    $tmpFilePath = $_FILES['photos']['tmp_name'][$i];
                    if($tmpFilePath != "")
                    {
                        $info1 = pathinfo($_FILES['photos']['name'][$i]);
                        $ext = $info1['extension'];
                        $avatar = time() . rand(10000,99999) . "_".$i."." . $ext; 
                        $newFilePath = "public/uploads/ngo/" . $avatar;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $photos[] = array("item_id" => time()."_".$i,"avatar" => $avatar);
                        }
                    }
                }
                if(!empty($photos)) {
                    $model = new Ngo;
                    $model->update($ngo_id,array("photos" => json_encode($photos)));
                }

                $documents = [];
                $total = count($_FILES['documents']['name']);
                for($i = 0; $i < $total; $i++)
                {
                    $tmpFilePath = $_FILES['documents']['tmp_name'][$i];
                    if($tmpFilePath != "")
                    {
                        $info1 = pathinfo($_FILES['documents']['name'][$i]);
                        $ext = $info1['extension'];
                        $avatar = time() . rand(10000,99999) . "_".$i."_doc." . $ext; 
                        $newFilePath = "public/uploads/ngo/" . $avatar;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $documents[] = array("item_id" => time()."_".$i,"avatar" => $avatar);
                        }
                    }
                }
                if(!empty($documents)) {
                    $model = new Ngo;
                    $model->update($ngo_id,array("documents" => json_encode($documents)));
                }

                $certifications = [];
                $total = count($_FILES['certifications']['name']);
                for($i = 0; $i < $total; $i++)
                {
                    $tmpFilePath = $_FILES['certifications']['tmp_name'][$i];
                    if($tmpFilePath != "")
                    {
                        $info1 = pathinfo($_FILES['certifications']['name'][$i]);
                        $ext = $info1['extension'];
                        $avatar = time() . rand(10000,99999) . "_".$i."_certi." . $ext; 
                        $newFilePath = "public/uploads/ngo/" . $avatar;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $certifications[] = array("item_id" => time()."_".$i,"avatar" => $avatar);
                        }
                    }
                }
                if(!empty($certifications)) {
                    $model = new Ngo;
                    $model->update($ngo_id,array("certifications" => json_encode($certifications)));
                }
            }
            return redirect('ngos');
        }

        public function edit($id)
        {
            $session = session();
            if($session->get("userdata")){
                $model = new Ngo;
                $data["ngo"] = $model->where('id',$id)->first();
                if($data["ngo"]) {
                    $model = new State;
                    $data["states"] = $model->select("id,name")->orderBy("name","asc")->get()->getResultArray();

                    return view("admin/ngo/add_edit",$data);
                }
            } else {
                return redirect("/");
            }
        }

        public function update($id)
        {
            $session = session();
            $post = $this->request->getVar();

            $post['updated_by'] = $this->userdata['id'];
            $post['updated_at'] = date('Y-m-d H:i:s');
            $model = new Ngo;
            if($model->update($post["ngo_id"],$post)) {
                $ngo_id = $post["ngo_id"];

                if($_FILES['banner']['name'] != "") {
                    $file = $this->request->getFile("banner");
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    $banner = "banner_".$file->getRandomName(); 
                    $file->move("public/uploads/ngo/", $banner);

                    $model = new Ngo;
                    $model->update($ngo_id,array("banner" => $banner));

                    if($post["old_banner"] != "" && file_exists("public/uploads/ngo/".$post["old_banner"]))
                        unlink("public/uploads/ngo/".$post["old_banner"]);
                }

                $photos = [];
                $total = count($_FILES['photos']['name']);
                for($i = 0; $i < $total; $i++)
                {
                    $tmpFilePath = $_FILES['photos']['tmp_name'][$i];
                    if($tmpFilePath != "")
                    {
                        $info1 = pathinfo($_FILES['photos']['name'][$i]);
                        $ext = $info1['extension'];
                        $avatar = time() . rand(10000,99999) . "_".$i."." . $ext; 
                        $newFilePath = "public/uploads/ngo/" . $avatar;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $photos[] = array("item_id" => time()."_".$i,"avatar" => $avatar);
                        }
                    }
                }
                if(!empty($photos)) {
                    $model = new Ngo;
                    $photo = $model->select("photos")->where('id',$ngo_id)->first();
                    $old_photos = array();
                    if($photo && $photo["photos"] != "") {
                        $old_photos = json_decode($photo["photos"],true);
                    }
                    $merge_photos = array_merge($old_photos,$photos);
                    $model->update($ngo_id,array("photos" => json_encode($merge_photos)));
                }

                $documents = [];
                $total = count($_FILES['documents']['name']);
                for($i = 0; $i < $total; $i++)
                {
                    $tmpFilePath = $_FILES['documents']['tmp_name'][$i];
                    if($tmpFilePath != "")
                    {
                        $info1 = pathinfo($_FILES['documents']['name'][$i]);
                        $ext = $info1['extension'];
                        $avatar = time() . rand(10000,99999) . "_".$i."_doc." . $ext; 
                        $newFilePath = "public/uploads/ngo/" . $avatar;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $documents[] = array("item_id" => time()."_".$i,"avatar" => $avatar);
                        }
                    }
                }
                if(!empty($documents)) {
                    $model = new Ngo;
                    $photo = $model->select("documents")->where('id',$ngo_id)->first();
                    $old_photos = array();
                    if($photo && $photo["documents"] != "") {
                        $old_photos = json_decode($photo["documents"],true);
                    }
                    $merge_photos = array_merge($old_photos,$documents);
                    $model->update($ngo_id,array("documents" => json_encode($merge_photos)));
                }

                $certifications = [];
                $total = count($_FILES['certifications']['name']);
                for($i = 0; $i < $total; $i++)
                {
                    $tmpFilePath = $_FILES['certifications']['tmp_name'][$i];
                    if($tmpFilePath != "")
                    {
                        $info1 = pathinfo($_FILES['certifications']['name'][$i]);
                        $ext = $info1['extension'];
                        $avatar = time() . rand(10000,99999) . "_".$i."_certi." . $ext; 
                        $newFilePath = "public/uploads/ngo/" . $avatar;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $certifications[] = array("item_id" => time()."_".$i,"avatar" => $avatar);
                        }
                    }
                }
                if(!empty($certifications)) {
                    $model = new Ngo;
                    $photo = $model->select("certifications")->where('id',$ngo_id)->first();
                    $old_photos = array();
                    if($photo && $photo["certifications"] != "") {
                        $old_photos = json_decode($photo["certifications"],true);
                    }
                    $merge_photos = array_merge($old_photos,$certifications);
                    $model->update($ngo_id,array("certifications" => json_encode($merge_photos)));
                }
            }
            return redirect('ngos');
        }

        public function show($id)
        {
            $model = new Ngo;
            $ngo = $model->select('banner,photos')->where("id",$id)->first();
            if($model->where('id',$id)->delete()) {
                if($ngo["banner"] != "" && file_exists("public/uploads/ngo/".$ngo["banner"])) {
                    unlink("public/uploads/ngo/".$ngo["banner"]);
                }
                if($ngo["photos"] != "") {
                    $photos = json_decode($ngo["photos"],true);
                    if($photos) {
                        foreach($photos as $photo) {
                            if($photo["avatar"] != "" && file_exists("public/uploads/ngo/".$photo["avatar"])) {
                                unlink("public/uploads/ngo/".$photo["avatar"]);
                            }           
                        }
                    }
                }
            }
            return redirect('ngos');
        }

        public function remove_photo()
        {
            $post = $this->request->getVar();

            $model = new Ngo;
            $ngo = $model->select("photos,documents,certifications")->where('id',$post["ngo_id"])->first();
            if($post["field"] == "photo") {
                if($ngo && $ngo["photos"] != "") {
                    $photos = json_decode($ngo["photos"],true);
                    if($photos) {
                        $new_photos = [];
                        foreach($photos as $photo) {
                            if($photo["item_id"] != $post["id"]) {
                                $new_photos[] = array(
                                    "item_id" => $photo["item_id"],
                                    "avatar" => $photo["avatar"]
                                );
                            }
                            if($photo["item_id"] == $post["id"]) {
                                if($photo["avatar"] != "" && file_exists("public/uploads/ngo/".$photo["avatar"])) {
                                    unlink("public/uploads/ngo/".$photo["avatar"]);
                                }
                            }
                        }
                        $model->update($post["ngo_id"],array("photos" => json_encode($new_photos)));
                    }
                }
            } else if($post["field"] == "document") {
                if($ngo && $ngo["documents"] != "") {
                    $documents = json_decode($ngo["documents"],true);
                    if($documents) {
                        $new_documents = [];
                        foreach($documents as $document) {
                            if($document["item_id"] != $post["id"]) {
                                $new_documents[] = array(
                                    "item_id" => $document["item_id"],
                                    "avatar" => $document["avatar"]
                                );
                            }
                            if($document["item_id"] == $post["id"]) {
                                if($document["avatar"] != "" && file_exists("public/uploads/ngo/".$document["avatar"])) {
                                    unlink("public/uploads/ngo/".$document["avatar"]);
                                }
                            }
                        }
                        $model->update($post["ngo_id"],array("documents" => json_encode($new_documents)));
                    }
                }
            } else {
                if($ngo && $ngo["certifications"] != "") {
                    $certifications = json_decode($ngo["certifications"],true);
                    if($certifications) {
                        $new_certifications = [];
                        foreach($certifications as $certification) {
                            if($certification["item_id"] != $post["id"]) {
                                $new_certifications[] = array(
                                    "item_id" => $certification["item_id"],
                                    "avatar" => $certification["avatar"]
                                );
                            }
                            if($certification["item_id"] == $post["id"]) {
                                if($certification["avatar"] != "" && file_exists("public/uploads/ngo/".$certification["avatar"])) {
                                    unlink("public/uploads/ngo/".$certification["avatar"]);
                                }
                            }
                        }
                        $model->update($post["ngo_id"],array("certifications" => json_encode($new_certifications)));
                    }
                }
            }
            echo json_encode(array("status" => 200));
            exit;
        }

        public function photos($id)
        {
            echo $id;
        }

        public function pending_ngos()
        {
            if(isset($this->userdata['id'])){
                $model = new Ngo;
                $data["ngos"] = $model->where('is_approved',0)->get()->getResultArray();

                $model = new State;
                $data["states"] = $model->select("id,name")->get()->getResultArray();

                $model = new City;
                $data["cities"] = $model->select("id,name")->get()->getResultArray();

                return view("admin/ngo/pending_list",$data);
            } else {
                return redirect("/");
            }
        }

        public function approve_ngo($id)
        {
            $model = new Ngo;
            $model->update($id,array("is_approved" => 1));

            return redirect("pending-ngos");
        }

        public function reject_ngo($id)
        {
            $model = new Ngo;
            $model->update($id,array("is_approved" => 2));

            return redirect("pending-ngos");
        }

        public function ngo_view($id)
        {
            if(isset($this->userdata['id'])){
                $data["is_applied"] = 0;
                $model = new Ngo;
                $data["ngo"] = $model->where('id',$id)->first();
                if($data["ngo"]) {
                    $model = new State;
                    $data["states"] = $model->select("id,name")->get()->getResultArray();

                    $model = new City;
                    $data["cities"] = $model->select("id,name")->get()->getResultArray();
                    
                    return view("admin/ngo/view",$data);
                }
            } else {
                return redirect("/");
            }
        }

        public function pg_list()
        {
            if(isset($this->userdata['id'])){
                $model = new Pg;
                $data["pgs"] = $model->where('is_approved',1)->orderBy('id',"desc")->get()->getResultArray();
                if($data["pgs"]) {
                    $model = new Feedback;
                    foreach($data["pgs"] as $key => $val) {
                        $rate = $model->selectSum("rate")->where('pg_mess_id',$val["id"])->where("feedback_type",1)->get()->getRowArray();
                        if($rate && !empty($rate["rate"])) {
                            $count = $model->where('pg_mess_id',$val["id"])->where("feedback_type",1)->get()->getResultArray();
                            $data["pgs"][$key]['rate'] = $rate["rate"]/count($count);
                        } else {
                            $data["pgs"][$key]['rate'] = 0;
                        }
                    }
                }
                $names = array();
                foreach ($data["pgs"] as $key => $val)
                {
                    $names[$key] = $val["rate"];
                }
                array_multisort($names, SORT_DESC, $data["pgs"]);

                return view("admin/pg/approved_pgs",$data);
            } else {
                return redirect("/");
            }       
        }

        public function apply_pg()
        {
            $documents = [];
            $total = count($_FILES['documents']['name']);
            for($i = 0; $i < $total; $i++)
            {
                $tmpFilePath = $_FILES['documents']['tmp_name'][$i];
                if($tmpFilePath != "")
                {
                    $info1 = pathinfo($_FILES['documents']['name'][$i]);
                    $ext = $info1['extension'];
                    $avatar = time() . rand(10000,99999) . "." . $ext; 
                    $newFilePath = "public/uploads/booking/" . $avatar;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $documents[] = array(
                            "item_id" => ($i+1),
                            "avatar" => $avatar
                        );
                    }
                }
            }
            $post = $this->request->getVar();
            $amount = 0;

            $model = new Pg;
            $pg = $model->select('rent')->where('id',$post["pg_id"])->first();
            if($pg) {
                $amount = $pg["rent"];
            }
            $insert_data = array(
                "pg_id" => $post["pg_id"],
                "pg_amount" => $amount,
                "status" => 0,
                "payment_status" => 0,
                "documents" => json_encode($documents),
                "screenshot" => "",
                "created_by" => $this->userdata['id'],
                "updated_by" => 0,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            );
            $model = new Pg_booking;
            $model->insert($insert_data);

            return redirect("pg-bookings");
        }

        public function pg_bookings()
        {
            if(isset($this->userdata['id'])){
                $model = db_connect();
                $booking = $model->table("pg_bookings pb");
                $booking = $booking->join("pgs p","p.id=pb.pg_id");
                $booking = $booking->select("pb.id,pb.pg_id,pb.pg_amount,pb.status,pb.payment_status,pb.documents,pb.screenshot,pb.created_at,p.name AS pg_name");
                $booking = $booking->where("pb.created_by",$this->userdata['id']);
                $data["bookings"] = $booking->get()->getResultArray();   
                if($data["bookings"]) {
                    foreach($data["bookings"] as $key => $val) {
                        $qrcode = "";
                        $model = new Pg;
                        $pg = $model->select('created_by')->where('id',$val["pg_id"])->first();
                        if($pg) {
                            $model = new User;
                            $user  = $model->select('qrcode')->where('id',$pg["created_by"])->first();
                            if($user) {
                                if($user["qrcode"] != "")
                                    $qrcode = base_url("public/uploads/qrcode/".$user["qrcode"]);
                            }
                        }
                        $data["bookings"][$key]["qrcode"] = $qrcode;
                    }
                }
                return view("admin/pg/booking",$data);
            } else {
                return redirect("/");
            }
        }

        public function make_payment()
        {
            $post = $this->request->getVar();

            $screenshot = "";
            if($_FILES['screenshot']['name'] != "") {
                $file = $this->request->getFile("screenshot");
                $name = $file->getName();
                $ext = $file->getClientExtension();

                // Get random file name
                $screenshot = $file->getRandomName(); 

                // Store file in public/uploads/ folder
                $file->move("public/uploads/booking/screenshot", $screenshot);

                $model = new Pg_booking;
                $model->update($post["booking_id"],array("screenshot" => $screenshot,"payment_status" => 1,"updated_by" => $this->userdata['id'],"updated_at" => date("Y-m-d H:i:s")));

                return redirect("pg-bookings");
            }
        }

        public function pg_feedback()
        {
            $post = $this->request->getVar();

            $insert_data = array(
                "pg_mess_id" => $post["pg_feedback_id"],
                "feedback_type" => 1,
                "rate" => $post["rate"],
                "comment" => $post["comment"],
                "created_by" => $this->userdata['id'],
                "updated_by" => 0,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            );
            $model = new Feedback;
            $model->insert($insert_data);

            return redirect("pg-list");    
        }

        public function my_pg_bookings()
        {
            if(isset($this->userdata['id'])){
                $model = new Pg;
                $mypgs = $model->select("id")->where("created_by",$this->userdata['id'])->get()->getResultArray();
                $ids = [];
                if($mypgs) {
                    foreach($mypgs as $val) {
                        $ids[] = $val["id"];
                    }
                } 
                $data["bookings"] = [];
                if(!empty($ids)) {
                    $model = db_connect();
                    $booking = $model->table("pg_bookings pb");
                    $booking = $booking->join("pgs p","p.id=pb.pg_id");
                    $booking = $booking->join("users u","u.id=pb.created_by");
                    $booking = $booking->select("pb.id,pb.pg_id,pb.pg_amount,pb.status,pb.payment_status,pb.documents,pb.screenshot,pb.created_at,p.name AS pg_name,u.name AS requested_by");
                    $booking = $booking->whereIn("pb.pg_id",$ids);
                    $data["bookings"] = $booking->get()->getResultArray();
                }
                return view("admin/pg/my_booking",$data);
            } else {
                return redirect("/");
            }
        }

        public function watch_pg_docs()
        {
            $photos = [];

            $model = new Pg_booking;
            $photo = $model->select("documents")->where("id",$this->request->getVar("booking_id"))->first();
            if($photo) {
                if($photo["documents"] != "") {
                    $photos = json_decode($photo["documents"],true);
                    foreach($photos as $key => $val) {
                        $photos[$key]["avatar"] = base_url("public/uploads/booking/".$val["avatar"]);
                    }
                }
            }
            echo json_encode(array("photos" => $photos));
            exit;
        }

        public function approve_pg_request($id)
        {
            $model = new Pg_booking;
            $model->update($id,array("status" => 1));
            return redirect("my-pg-bookings");
        }

        public function reject_pg_request($id)
        {
            $model = new Pg_booking;
            $model->update($id,array("status" => 2));
            return redirect("my-pg-bookings");
        }

        public function pg_feedbacks()
        {
            if(isset($this->userdata['id'])){
                $model = new Pg;
                $mypgs = $model->select("id")->where("created_by",$this->userdata['id'])->get()->getResultArray();
                $ids = [];
                if($mypgs) {
                    foreach($mypgs as $val) {
                        $ids[] = $val["id"];
                    }
                } 
                $data["feedbacks"] = [];
                if(!empty($ids)) {
                    $model = db_connect();
                    $booking = $model->table("feedbacks f");
                    $booking = $booking->join("pgs p","p.id=f.pg_mess_id");
                    $booking = $booking->join("users u","u.id=f.created_by");
                    $booking = $booking->select("f.id,f.rate,f.comment,f.created_at,u.name AS commented_by");
                    $booking = $booking->whereIn("f.pg_mess_id",$ids);
                    $booking = $booking->where("f.feedback_type",1);
                    $data["feedbacks"] = $booking->get()->getResultArray();
                }
                return view("admin/pg/feedback",$data);
            } else {
                return redirect("/");
            }
        }

        public function get_state_wise_city()
        {
            $model = new City;
            $cities = $model->select('id,name')->where('state_id',$this->request->getVar('state_id'))->get()->getResultArray();
            echo json_encode(array("status" => empty($cities) ? 201 : 200,"data" => $cities));
            exit;
        }

        public function ngo_payments()
        {
            $session = session();
            if(isset($this->userdata['id'])){
                $ids = [];
                
                $model = new Ngo;
                $ngos = $model->select('id')->where('created_by',$this->userdata['id'])->get()->getResultArray();
                if($ngos) {
                    foreach($ngos as $key => $val) {
                        $ids[] = $val['id'];
                    }
                }
                $payments = [];
                if(!empty($ids)) {
                    $model = db_connect();
                    $payment = $model->table("payments p");
                    $payment = $payment->join("ngos n","n.id=p.ngo_id");
                    $payment = $payment->join("users u","u.id=p.created_by");
                    $payment = $payment->select("p.id,p.amount,n.name AS ngo,u.name AS donor,p.created_at");
                    $payment = $payment->whereIn("p.ngo_id",$ids);
                    $payment = $payment->where("p.status",1);
                    $data["payments"] = $payment->get()->getResultArray();
                    $data["menu_title"] = "Payments";

                    return view("admin/ngo/payments",$data);
                }
            } else {
                return redirect("/");
            }
        }

        public function all_ngos()
        {
            $session = session();
            if(isset($this->userdata['id'])){
                $model = db_connect();
                $ngo = $model->table("ngos n");
                $ngo = $ngo->join("states s","s.id=n.state");
                $ngo = $ngo->join("cities c","c.id=n.city");
                $ngo = $ngo->select("n.id,n.name,n.email,n.phone,n.address,s.name AS state,c.name AS city");
                $ngo = $ngo->where("n.is_approved",1);
                $data["ngos"] = $ngo->get()->getResultArray();
                return view("admin/ngo/all_ngos",$data);
            }
        }
    }