<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AnotherUsers Controller
 *
 * @property \App\Model\Table\AnotherUsersTable $AnotherUsers
 * @method \App\Model\Entity\AnotherUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnotherUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $anotherUsers = $this->paginate($this->AnotherUsers);

        $this->set(compact('anotherUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Another User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $anotherUser = $this->AnotherUsers->get($id, [
            'contain' => ['Posts'],
        ]);

        $this->set(compact('anotherUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $anotherUser = $this->AnotherUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $anotherUser = $this->AnotherUsers->patchEntity($anotherUser, $this->request->getData());
            if ($this->AnotherUsers->save($anotherUser)) {
                $this->Flash->success(__('The another user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The another user could not be saved. Please, try again.'));
        }
        $this->set(compact('anotherUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Another User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $anotherUser = $this->AnotherUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $anotherUser = $this->AnotherUsers->patchEntity($anotherUser, $this->request->getData());
            if ($this->AnotherUsers->save($anotherUser)) {
                $this->Flash->success(__('The another user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The another user could not be saved. Please, try again.'));
        }
        $this->set(compact('anotherUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Another User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $anotherUser = $this->AnotherUsers->get($id);
        if ($this->AnotherUsers->delete($anotherUser)) {
            $this->Flash->success(__('The another user has been deleted.'));
        } else {
            $this->Flash->error(__('The another user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
