<?php
App::uses('AppController', 'Controller');
class UsersShowController extends AppController {
   
    public $uses = array('User','UsersPoint');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
        $this->autoRender = false;
        $this->notFound = __('Invalid Request.');
    }

    public function index() {
        $response = array();
        $data = json_decode($this->request->input(),true);
        if(!empty($data)){
            if (isset($data['users_api_token'])) {
                $userToken = $data['users_api_token'];
                $this->User->recursive = -1;
                $getUserInfo = $this->User->find('first', array(
                        'conditions' => array(
                            'User.api_token' => $userToken
                        ),
                        'fields' => array(
                            'User.id',
                            'User.nickname',
                            'User.gender',
                            'User.birthday',
                            'User.image',
                            'User.status',
                            'User.admin_flg',
                            'User.charge_flg',
                            'User.fail_flg',
                            'User.created',
                            'User.email'
                        )
                    )
                );
                
                $userCreated = strtotime($getUserInfo['User']['created']);
                $julyLimit = strtotime("2015-07-01 00:00:00");

                if ($getUserInfo['User']['admin_flg'] == 1) {
                    $status = 3; // paid
                } else if ($userCreated < $julyLimit && $getUserInfo['User']['charge_flg'] == 0) {
                    $status = 1; // expired
                } else if ($getUserInfo['User']['fail_flg'] == 1) {
                    $status = 2; // failed
                } else if ($getUserInfo['User']['charge_flg'] == 0) {
                    $status = 0; // free
                } else if ($getUserInfo['User']['charge_flg'] == 1) {
                    $status = 3; // paid
                }
                
                $coins = @$this->UsersPoint->getCurrentUserPoint($getUserInfo['User']['id']);
                
                if ($getUserInfo && trim($data['users_api_token']) != ""){
                    if (!empty($getUserInfo['User']['image'])) {
                        $userImage = FULL_BASE_URL .'/user/img/uploads/'.$getUserInfo['User']['image'];
                    } else {
                        $userImage = FULL_BASE_URL .'/user/img/no_profile_img.jpg';
                    }
                    $response = array(
                        'users_username' => $getUserInfo['User']['nickname'],
                        'users_gender' => intval($getUserInfo['User']['gender']),
                        'users_birthday' => $getUserInfo['User']['birthday'],
                        'profile_image' => $userImage,
                        'account_status' => $status,
                        'coin' => intval($coins),
                        'users_email' => $getUserInfo['User']['email']
                      );
                    
                } else {
                    $response['error']['message'] = 'Invalid token.';
                }
            } else {
                $response['error']['message'] = $this->notFound;
            }
        } else {
            $response['error']['message'] = $this->notFound;
        }
        echo json_encode($response);
    }
}
