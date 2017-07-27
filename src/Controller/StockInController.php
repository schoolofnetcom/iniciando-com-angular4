<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StockIn Controller
 *
 * @property \App\Model\Table\StockInTable $StockIn
 */
class StockInController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products']
        ];
        $stockIn = $this->paginate($this->StockIn);
        $request = $this->request;

        $this->set(compact('stockIn', 'request'));
        $this->set('_serialize', ['stockIn', 'request']);
    }

    /**
     * View method
     *
     * @param string|null $id Stock In id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockIn = $this->StockIn->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('stockIn', $stockIn);
        $this->set('_serialize', ['stockIn']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockIn = $this->StockIn->newEntity();
        if ($this->request->is('post')) {
            $stockIn = $this->StockIn->patchEntity($stockIn, $this->request->getData());
            if ($this->StockIn->save($stockIn)) {
                $product_id = $this->request->data['product_id'];
                $product = $this->StockIn->Products->get($product_id);
                $this->StockIn->stockIn($product, $this->request->data['quantity']);
                $this->Flash->success(__('The stock in has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock in could not be saved. Please, try again.'));
        }
        $products = $this->StockIn->Products->find('list', ['limit' => 200]);
        $this->set(compact('stockIn', 'products'));
        $this->set('_serialize', ['stockIn']);
    }

    public function create()
    {
        $stockIn = $this->StockIn->newEntity($this->request->getData());
        if ($this->StockIn->save($stockIn)) {
            $product_id = $this->request->data['product_id'];
            $product = $this->StockIn->Products->get($product_id);
            $this->StockIn->stockIn($product, $this->request->data['quantity']);
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'stockIn' => $stockIn,
            '_serialize' => ['message', 'stockIn']
        ]);
    }
}
