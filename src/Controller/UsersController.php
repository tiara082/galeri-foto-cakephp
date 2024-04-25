<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = $this->Authentication->getIdentity()->id;
        
        // Mengambil data foto-foto yang diperlukan
        $photos = $this->Users->Photos->find()
            ->contain(['Users', 'Photocomments.Users'])
            ->orderDesc('Photos.created') // Order by creation date in descending order
            ->toArray();
    
        // Mengambil data foto-foto yang dimiliki oleh pengguna yang sedang login
        $photosbyUser = $this->Users->Photos->find()
            ->where(['Photos.user_id' => $userId]) // Filter by user ID
            ->toArray();
    
        // Mengambil data likes yang dimiliki oleh pengguna yang sedang login
        $likes = $this->Users->Photos->Likephotos->find()
            ->where(['Likephotos.user_id' => $userId])
            ->toArray();
    
        // Mengambil data album yang dimiliki oleh pengguna yang sedang login
        $albumsByUser = $this->Users->Albums->find()
            ->where(['Albums.user_id' => $userId]) // Filter berdasarkan ID pengguna
            ->toArray();
    
        // Menghitung jumlah foto, jumlah koleksi pribadi, dan jumlah likes
        $jumlahFoto = count($photosbyUser); 
        $jumlahKoleksiPribadi = $this->Users->Albums->find()
            ->where(['Albums.user_id' => $userId])
            ->count();
        $jumlahLikes = count($likes);
    
        // Mengatur apakah setiap foto dilike oleh pengguna
        foreach ($photos as $photo) {
            $photo->is_liked = $this->Users->Photos->Likephotos->exists(['user_id' => $userId, 'photo_id' => $photo->id]);
        }
    
        // Mengambil data komentar untuk setiap foto
        foreach ($photos as $photo) {
            $photo->comments = $this->Users->Photos->Photocomments->find()
                ->where(['photo_id' => $photo->id])
                ->contain(['Users']) // Menyertakan data user pada komentar
                ->toArray();
        }
    
        // Set data untuk ditampilkan di view
        $this->set(compact('jumlahFoto', 'jumlahKoleksiPribadi', 'jumlahLikes', 'photos', 'likes', 'albumsByUser'));
    }
    
    
    
    

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Albums', 'Likephotos', 'Photocomments', 'Photos']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login','register']);
}

public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        // redirect to /articles after login success
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Users',
            'action' => 'index',
        ]);

        return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }
}
public function logout()
{
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}
}
