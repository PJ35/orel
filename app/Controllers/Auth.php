<?php

namespace App\Controllers;

class Auth extends \IonAuth\Controllers\Auth
{
    /**
     * If you want to customize the views,
     *  - copy the ion-auth/Views/auth folder to your Views folder,
     *  - remove comment
     */
    protected $viewsFolder = 'auth';

    /**
     * Create user with the reduced custom form fields.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function create_user()
    {
        $this->data['title'] = lang('Auth.create_user_heading');

        if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin()) {
            return redirect()->to('/auth');
        }

        $tables = $this->configIonAuth->tables;
        $identityColumn = $this->configIonAuth->identity;
        $this->data['identity_column'] = $identityColumn;

        if ($identityColumn !== 'email') {
            $this->validation->setRule('identity', lang('Auth.create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identityColumn . ']');
            $this->validation->setRule('email', lang('Auth.create_user_validation_email_label'), 'trim|required|valid_email');
        } else {
            $this->validation->setRule('email', lang('Auth.create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }

        $this->validation->setRule('password', lang('Auth.create_user_validation_password_label'), 'required|min_length[' . $this->configIonAuth->minPasswordLength . ']|matches[password_confirm]');
        $this->validation->setRule('password_confirm', lang('Auth.create_user_validation_password_confirm_label'), 'required');

        if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $email = strtolower((string) $this->request->getPost('email'));
            $identity = $identityColumn === 'email' ? $email : $this->request->getPost('identity');
            $password = $this->request->getPost('password');

            $additionalData = [
                'first_name' => null,
                'last_name' => null,
                'company' => null,
                'phone' => null,
            ];

            if ($this->ionAuth->register($identity, $password, $email, $additionalData)) {
                $this->session->setFlashdata('message', $this->ionAuth->messages());

                return redirect()->to('/auth');
            }
        }

        $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));

        $this->data['identity'] = [
            'name' => 'identity',
            'id' => 'identity',
            'type' => 'text',
            'value' => set_value('identity'),
        ];
        $this->data['email'] = [
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'value' => set_value('email'),
        ];
        $this->data['password'] = [
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'value' => set_value('password'),
        ];
        $this->data['password_confirm'] = [
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'value' => set_value('password_confirm'),
        ];

        return $this->renderPage($this->viewsFolder . DIRECTORY_SEPARATOR . 'create_user', $this->data);
    }

    /**
     * Edit user with the reduced custom form fields.
     *
     * @param int $id
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function edit_user(int $id)
    {
        $this->data['title'] = lang('Auth.edit_user_heading');

        if (! $this->ionAuth->loggedIn() || (! $this->ionAuth->isAdmin() && ! ($this->ionAuth->user()->row()->id == $id))) {
            return redirect()->to('/auth');
        }

        $user = $this->ionAuth->user($id)->row();
        $groups = $this->ionAuth->groups()->resultArray();
        $currentGroups = $this->ionAuth->getUsersGroups($id)->getResult();

        if (! empty($_POST)) {
            if ($id !== $this->request->getPost('id', FILTER_VALIDATE_INT)) {
                throw new \Exception(lang('Auth.error_security'));
            }

            if ($this->request->getPost('password')) {
                $this->validation->setRule('password', lang('Auth.edit_user_validation_password_label'), 'required|min_length[' . $this->configIonAuth->minPasswordLength . ']|matches[password_confirm]');
                $this->validation->setRule('password_confirm', lang('Auth.edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
                $data = [];

                if ($this->request->getPost('password')) {
                    $data['password'] = $this->request->getPost('password');
                }

                if ($this->ionAuth->isAdmin()) {
                    $groupData = $this->request->getPost('groups');

                    if (! empty($groupData)) {
                        $this->ionAuth->removeFromGroup('', $id);

                        foreach ($groupData as $grp) {
                            $this->ionAuth->addToGroup($grp, $id);
                        }
                    }
                }

                if (! empty($data) && $this->ionAuth->update($user->id, $data)) {
                    $this->session->setFlashdata('message', $this->ionAuth->messages());
                } elseif (! empty($data)) {
                    $this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
                } else {
                    $this->session->setFlashdata('message', 'User updated.');
                }

                return $this->ionAuth->isAdmin() ? redirect()->to('/auth') : redirect()->to('/');
            }
        }

        $this->data['message'] = $this->validation->getErrors()
            ? $this->validation->listErrors($this->validationListTemplate)
            : ($this->ionAuth->errors($this->validationListTemplate)
                ? $this->ionAuth->errors($this->validationListTemplate)
                : $this->session->getFlashdata('message'));

        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        $this->data['ionAuth'] = $this->ionAuth;

        $this->data['password'] = [
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
        ];
        $this->data['password_confirm'] = [
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
        ];

        return $this->renderPage($this->viewsFolder . DIRECTORY_SEPARATOR . 'edit_user', $this->data);
    }
}