<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Likephotos Controller
 *
 * @property \App\Model\Table\LikephotosTable $Likephotos
 */
class LikephotosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Likephotos->find()
            ->contain(['Users', 'Photos']);
        $likephotos = $this->paginate($query);

        $this->set(compact('likephotos'));
    }

    /**
     * View method
     *
     * @param string|null $id Likephoto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $likephoto = $this->Likephotos->get($id, contain: ['Users', 'Photos']);
        $this->set(compact('likephoto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */


    
 
    public function add()
    {
        $likephoto = $this->Likephotos->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $userId = $this->Authentication->getIdentity()->id;
            $existingLike = $this->Likephotos->find()
            ->where(['user_id' => $userId, 'photo_id' => $data['photo_id']])
            ->first();
            if ($existingLike) {
                $this->Flash->error(__('You have already liked this photo.'));
            } else {
                $likephoto = $this->Likephotos->patchEntity($likephoto, [
                    'user_id' => $userId,
                    'photo_id' => $data['photo_id'],
                ]);            
                
                if ($this->Likephotos->save($likephoto)) {
                $this->Flash->success(__('The likephoto has been saved.'));

                // return $this->redirect(['action' => 'index']);
                }else {
                    $this->Flash->error(__('The likephoto could not be saved. Please, try again.'));

                }
        }
        return $this->redirect($this->referer());

    }
        return $this->redirect($this->referer());

    }

    /**
     * Edit method
     *
     * @param string|null $id Likephoto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $likephoto = $this->Likephotos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $likephoto = $this->Likephotos->patchEntity($likephoto, $this->request->getData());
            if ($this->Likephotos->save($likephoto)) {
                $this->Flash->success(__('The likephoto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The likephoto could not be saved. Please, try again.'));
        }
        $users = $this->Likephotos->Users->find('list', limit: 200)->all();
        $photos = $this->Likephotos->Photos->find('list', limit: 200)->all();
        $this->set(compact('likephoto', 'users', 'photos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Likephoto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        
        // Mendapatkan ID pengguna yang sedang login
        $userId = $this->Authentication->getIdentity()->id;
    
        // Mengambil data yang dikirim melalui form
        $data = $this->request->getData();
    
        // Cari data likephoto yang ingin dihapus berdasarkan user_id dan photo_id
        $existingLike = $this->Likephotos->find()
            ->where(['user_id' => $userId, 'photo_id' => $data['photo_id']])
            ->first();
    
        if ($existingLike) {
            // Jika data likephoto ditemukan, lakukan penghapusan
            if ($this->Likephotos->delete($existingLike)) {
                $this->Flash->success(__('The likephoto has been deleted.'));
            } else {
                $this->Flash->error(__('The likephoto could not be deleted. Please, try again.'));
            }
        } else {
            // Jika data likephoto tidak ditemukan, tampilkan pesan kesalahan
            $this->Flash->error(__('You have not liked this photo.'));
        }
    
        return $this->redirect($this->referer());
    }
    
}
