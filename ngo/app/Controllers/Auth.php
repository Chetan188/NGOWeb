<?php
    namespace App\Controllers;

    use App\Models\User;

    class Auth extends BaseController
    {
        protected $helpers = ["custom"];

        public function index(): string
        {
            $data["page_title"] = "Super Admin Portal";
            $data["role"] = 1;
            return view('auth/landing',$data);
        }

        public function admin(): string
        {
            $data["page_title"] = "Super Admin Portal";
            $data["role"] = 3;
            return view('auth/sign_in',$data);
        }

        public function ngo_sign_in(): string
        {
            $data["page_title"] = "NGO Portal";
            $data["role"] = 2;
            return view('auth/sign_in',$data);
        }
        

        public function donor_sign_in(): string
        {
            $data["page_title"] = "Donor Portal";
            $data["role"] = 1;
            return view('auth/sign_in',$data);
        }

        public function student_sign_in(): string
        {
            $data["page_title"] = "Student Portal";
            $data["role"] = 4;
            return view('auth/sign_in',$data);
        }

        public function sign_up($role = "")
        {
            $data["role"] = $role;
            return view('auth/sign_up',$data);
        }

        public function submitSignIn()
        {
            $session = session();
            $post = $this->request->getVar();
            
            $model = new User;
            $row = $model->where('email',$post['email'])->where('password',md5($post['password']))->first();
            if($row) {
                if($row['is_approved'] == 1) {
                    $session->set('userdata',$row);
                    return redirect('dashboard');
                } else if($row['is_approved'] == 0) {
                    $session->setFlashData('error','Your account is under review.');
                    return redirect("/");    
                } else {
                    $session->setFlashData('error','Your account has been rejected by admin.');
                    return redirect("/");    
                }
            } else {
                $session->setFlashData('error','Email or password is incorrect.');
                return redirect("/");
            }
        }

        public function submitSignUp()
        {
            $session = session();
            $post = $this->request->getVar();

            $model = new User;
            $email = $model->where('email',$post["email"])->get()->getResultArray();
            if(count($email) == 0) {
                $insert_data = array(
                    "name" => $post["name"],
                    "email" => $post["email"],
                    "phone" => $post["phone"],
                    "password" => md5($post["password"]),
                    "role" => $post["role"],
                    "is_approved" => $post["role"] == 1 ? 0 : 1,
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                );
                $model->insert($insert_data);

                $session->setFlashData('error','Your account has been created successfully.');
                if($post["role"] == 1) {
                    return redirect("donor-sign-in");
                } else if($post["role"] == 2) {
                    return redirect("ngo-sign-in");
                } else {
                    return redirect("sign-in");
                }
            } else {
                $session->setFlashData('error','Email already exist.');
                return redirect("sign-up/".$post['role']);
            }
        }

        public function logout()
        {
            $session = session();
            $userdata = $session->get("userdata");

            return redirect('/');
            // $session->destroy();
            // if($userdata['role'] == 1) {
            //     return redirect('sign-in');   
            // } else if($userdata['role'] == 2) {
            //     return redirect('pg-sign-in');   
            // } else if($userdata['role'] == 3) {
            //     return redirect('mess-sign-in');   
            // } else {
            //     return redirect('student-sign-in');   
            // }
        }
    }
