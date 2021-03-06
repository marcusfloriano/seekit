<?php
namespace SeekIt\Controller;

use Cake\Event\Event;
use Cake\Core\Configure;

use SeekIt\Controller\AppController;

/**
 * Seek Controller
 *
 * @property \SeekIt\Model\Table\SeekTable $Seek
 *
 * @method \SeekIt\Model\Entity\Seek[] paginate($object = null, array $settings = [])
 */
class SeekController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if($this->Auth) {
            $this->Auth->allow();
        }
        $this->loadModel('SeekIt.SeekItDocuments');
        $this->loadModel('SeekIt.SeekItDocumentFields');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $term = (empty($this->request->query("seek-it-search"))) ? "" : $this->request->query("seek-it-search");
        $this->set('term', htmlentities($term) );
        $this->set('results',[]);
        if($term != "") {
            try {
                $term = preg_replace("/[\.\-]+/","",$term);
                $results =  $this->SeekItDocuments->find()
                    ->select(["rating" => "MATCH (title, subtitle, body) AGAINST ('$term')"])
                    ->autoFields(true)
                    ->where([
                        "MATCH(title, subtitle, body) AGAINST('$term' IN BOOLEAN MODE)"
                    ])
                    ->contain(['SeekItDocumentFields'])
                    ->order(['rating' => 'desc']);
                $this->set('results', $results );
            } catch(\PDOException $e) {
                // Excepetion when erro on execute the searching
            }
        }
    }

    /**
     * View method
     *
     * @param string|null $id Seek id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $seek = $this->Seek->get($id, [
            'contain' => []
        ]);

        $this->set('seek', $seek);
        $this->set('_serialize', ['seek']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $seek = $this->Seek->newEntity();
        if ($this->request->is('post')) {
            $seek = $this->Seek->patchEntity($seek, $this->request->getData());
            if ($this->Seek->save($seek)) {
                $this->Flash->success(__('The seek has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The seek could not be saved. Please, try again.'));
        }
        $this->set(compact('seek'));
        $this->set('_serialize', ['seek']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Seek id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $seek = $this->Seek->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $seek = $this->Seek->patchEntity($seek, $this->request->getData());
            if ($this->Seek->save($seek)) {
                $this->Flash->success(__('The seek has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The seek could not be saved. Please, try again.'));
        }
        $this->set(compact('seek'));
        $this->set('_serialize', ['seek']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Seek id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $seek = $this->Seek->get($id);
        if ($this->Seek->delete($seek)) {
            $this->Flash->success(__('The seek has been deleted.'));
        } else {
            $this->Flash->error(__('The seek could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
