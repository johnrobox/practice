<?php
	$id = NULL;
		if ($this->facebook->getUser()) {
			$id = $this->facebook->getUser();
		}
		$loginUrl = $this->facebook->getLoginUrl(array(
			'scope' => Configure::read('my.fb_app_scope')
		));
		if (!$id) {
			$error = $this->params['error'];
			if (!$error) {
				return $this->redirect($loginUrl);
			} else {
				return $this->redirect('/login');
			}
		} else {
			$fb = $this->facebook->api('/me', 'GET');
			if ($fb) {
				$conditions = array(
					'facebook_id' => $fb['id'],
					'User.status !=' => 9
				);
				$data = $this->User->find('first',array('conditions'=>$conditions));
				if (isset($data['User'])) {
					$user = $data['User'];
					if ($user['status'] == 1) {
						//set to login
						$user['type'] = 'user';
						$this->Auth->login($user);
						$this->setLoginLog();
						return $this->redirect('/home');
					} else {
						$this->Session->setFlash(__('Your account is not yet activated please check your email for the activation link'),'default',array(),'auth');
						return $this->redirect('/login');
					}
				} else {
					//registration
					$this->Session->write('register',array(
						'type' => 'fb', //native, fb, google
						'data' => array(
							'nickname' => $fb['name'],
							'email' => $fb['email'],
							'gender' => ($fb['gender'] == 'male')?1:2,
							'facebook_id' => $fb['id']
						)
					));
					return $this->redirect('/register');
				}
			}
			exit();
		}

