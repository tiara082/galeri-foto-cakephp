<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Photocomments Controller
 *
 * @property \App\Model\Table\PhotocommentsTable $Photocomments
 */
class PhotocommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Photocomments->find()
            ->contain(['Users', 'Photos']);
        $photocomments = $this->paginate($query);

        $this->set(compact('photocomments'));
    }

    /**
     * View method
     *
     * @param string|null $id Photocomment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $photocomment = $this->Photocomments->get($id, contain: ['Users', 'Photos']);
        $this->set(compact('photocomment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $photocomment = $this->Photocomments->newEmptyEntity();
        if ($this->request->is('post')) {
            $photocomment = $this->Photocomments->patchEntity($photocomment, $this->request->getData());
            if ($this->Photocomments->save($photocomment)) {
                $this->Flash->success(__('The photocomment has been saved.'));
                return $this->redirect($this->referer()); // Kembali ke halaman sebelumnya
            }
            $this->Flash->error(__('The photocomment could not be saved. Please, try again.'));
        }
        $users = $this->Photocomments->Users->find('list', limit: 200)->all();
        $photos = $this->Photocomments->Photos->find('list', limit: 200)->all();
        $this->set(compact('photocomment', 'users', 'photos'));
    }
    

    /**
     * Edit method
     *
     * @param string|null $id Photocomment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $photocomment = $this->Photocomments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $photocomment = $this->Photocomments->patchEntity($photocomment, $this->request->getData());
            if ($this->Photocomments->save($photocomment)) {
                $this->Flash->success(__('The photocomment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photocomment could not be saved. Please, try again.'));
        }
        $users = $this->Photocomments->Users->find('list', limit: 200)->all();
        $photos = $this->Photocomments->Photos->find('list', limit: 200)->all();
        $this->set(compact('photocomment', 'users', 'photos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Photocomment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photocomment = $this->Photocomments->get($id);
        if ($this->Photocomments->delete($photocomment)) {
            $this->Flash->success(__('The photocomment has been deleted.'));
        } else {
            $this->Flash->error(__('The photocomment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
