<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Photos Controller
 *
 * @property \App\Model\Table\PhotosTable $Photos
 */
class PhotosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
public function index()
{
    // Ambil ID user yang sedang login
    $userId = $this->Authentication->getIdentity()->get('id');

    // Ambil data foto milik user yang sedang login
    $query = $this->Photos->find()
    ->where(['Photos.user_id' => $userId])  // Menambahkan alias tabel Photos
     ->contain(['Albums', 'Users']);
    
    $photos = $this->paginate($query);

    $this->set(compact('photos'));
}


    /**
     * View method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $photo = $this->Photos->get($id, contain: ['Albums', 'Users', 'Likephotos', 'Photocomments']);
        $this->set(compact('photo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        
        $photo = $this->Photos->newEmptyEntity();
        if ($this->request->is('post')) {
            $photo = $this->Photos->patchEntity($photo, $this->request->getData());
            $file = $this->request->getUploadedFiles();
            
            $photo->foto = $file['gambar']->getClientFilename();
            $file['gambar']->moveTo(WWW_ROOT . 'img' . DS .'postingan' . DS . $photo->foto);
            if ($this->Photos->save($photo)) {
                $this->Flash->success(__('The photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photo could not be saved. Please, try again.'));
        }
        $albums = $this->Photos->Albums->find('list', limit: 200)->all();
        $users = $this->Photos->Users->find('list', limit: 200)->all();
        $this->set(compact('photo', 'albums', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $photo = $this->Photos->get($id, contain: []);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $photo = $this->Photos->patchEntity($photo, $this->request->getData());
            $file = $this->request->getUploadedFiles();

            if(!empty($file['gambar']->getClientFilename())){
                $photo->foto = $file['gambar']->getClientFilename();
                $file['gambar']->moveTo(WWW_ROOT . 'img' . DS .'postingan' . DS . $photo->foto);
            }
            if ($this->Photos->save($photo)) {
                $this->Flash->success(__('The photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photo could not be saved. Please, try again.'));
        }
        $albums = $this->Photos->Albums->find('list', limit: 200)->all();
        $users = $this->Photos->Users->find('list', limit: 200)->all();
        $this->set(compact('photo', 'albums', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        if ($this->Photos->delete($photo)) {
            $this->Flash->success(__('The photo has been deleted.'));
        } else {
            $this->Flash->error(__('The photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
