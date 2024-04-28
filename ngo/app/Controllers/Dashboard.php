<?php
    namespace App\Controllers;

    use App\Models\User;
    use App\Models\Payment;
    use App\Models\Ngo;

    class Dashboard extends BaseController
    {
        protected $helpers = ["custom"];

        public function __construct()
        {
            $session = session();
            $this->userdata = $session->get('userdata');
        }

        public function index(): string
        {
            $session = session();
            if($session->get('userdata')){
                if($session->get('userdata')['role'] == 1) {
                    $model = new Ngo;
                    $ngos = $model->select('id')->get()->getResultArray();
                    $data["total_ngos"] = count($ngos);

                    $model = new User;
                    $users = $model->select('id')->where('role',1)->get()->getResultArray();
                    $data["total_donors"] = count($users);
                    
                    return view('admin/dashboard',$data);
                } else if($session->get('userdata')['role'] == 2) {
                    $ids = [];
                
                    $model = new Ngo;
                    $ngos = $model->select('id')->where('created_by',$this->userdata['id'])->get()->getResultArray();
                    if($ngos) {
                        foreach($ngos as $key => $val) {
                            $ids[] = $val['id'];
                        }
                    }
                    $data["total_ngos"] = count($ids);
                    $data["total_payments"] = 0;
                    if(!empty($ids)) {
                        $model = new Payment;
                        $total_payments = $model->selectSum("amount")->whereIn('ngo_id',$ids)->get()->getRowArray();
                        if(isset($total_payments['amount']) && $total_payments['amount'] != "" && $total_payments['amount'] != 0) {
                            $data["total_payments"] = $total_payments['amount'];
                        }
                    }
                    $data["today_payments"] = 0;
                    if(!empty($ids)) {
                        $model = new Payment;
                        $total_payments = $model->selectSum("amount")->whereIn('ngo_id',$ids)->where('DATE(created_at)',date('Y-m-d'))->get()->getRowArray();
                        if(isset($total_payments['amount']) && $total_payments['amount'] != "" && $total_payments['amount'] != 0) {
                            $data["today_payments"] = $total_payments['amount'];
                        }
                    }
                    return view('admin/ngo_dashboard',$data);
                } else {
                    $model = new Ngo;
                    $total_ngos = $model->get()->getResultArray();
                    $data["total_ngos"] = count($total_ngos);
                    $data["total_donors"] = 0;

                    return view('admin/dashboard',$data);
                }
            } else {
                return redirect("sign-in");
            }
        }

        public function remove_photo()
        {
            $model = new Photo;
            $photo = $model->select("avatar")->where("id",$this->request->getVar('id'))->first();
            if($photo) {
                $model->delete($this->request->getVar('id'));
                if($photo["avatar"] != "" && file_exists("public/uploads/pg/".$photo["avatar"]))
                    unlink("public/uploads/pg/".$photo["avatar"]);
            }
            echo json_encode(array("status" => 200));
            exit;
        }

        public function profile()
        {
            if(isset($this->userdata['id'])){
                $model = new User;
                $data["profile"] = $model->where('id',$this->userdata['id'])->first();
                return view('admin/profile',$data);
            } else {
                return redirect("/");
            }
        }

        public function submit_profile()
        {
            if(isset($this->userdata['id'])){
                $post = $this->request->getVar();

                $post["qrcode"] = $post["old_qrcode"];
                if($_FILES['qrcode']['name'] != "") {
                    $file = $this->request->getFile("qrcode");
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    // Get random file name
                    $post["qrcode"] = $file->getRandomName(); 

                    // Store file in public/uploads/ folder
                    $file->move("public/uploads/qrcode/", $post["qrcode"]);

                    if($post["old_qrcode"] != "" && file_exists("public/uploads/qrcode/".$post["old_qrcode"]))
                        unlink("public/uploads/qrcode/".$post["old_qrcode"]);
                }
                $model = new User;
                $model->update($this->userdata['id'],$post);

                return redirect("profile");
            } else {
                return redirect("/");
            }
        }

        public function transactions()
        {
            $session = session();
            if(isset($this->userdata['id'])){
                $model = db_connect();
                $payment = $model->table("payments p");
                $payment = $payment->join("ngos n","n.id=p.ngo_id");
                $payment = $payment->join("users u","u.id=p.created_by");
                $payment = $payment->select("p.id,p.amount,n.name AS ngo,u.name AS donor,p.created_at");
                $payment = $payment->where("p.status",1);
                $data["payments"] = $payment->get()->getResultArray();
                $data["menu_title"] = "Transactions";

                return view("admin/ngo/payments",$data);
            } else {
                return redirect("/");
            }
        }

        public function delete_account()
        {
            $session = session();

            $model = new User;
            $model->delete($session->get('userdata')['id']);

            $session->destroy();
            return redirect('/');
        }
    }
