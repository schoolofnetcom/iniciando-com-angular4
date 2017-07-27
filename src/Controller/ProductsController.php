<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain'=> [
                'Stock'
            ]
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Stock', 'StockIn', 'StockOut']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if (!$this->Products->save($product)) {
                $this->set(['errors'=>$product->errors()]);
                $this->set('_serialize', ['errors']);
            }
            return null;
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $this->Products->save($product);
            return null;
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
        $this->set('_serialize', ['product']);
    }

    public function create()
    {

        $data = $this->request->getData();
        $data['stock'] = [
            'quantity'=> 0,
            'unit_price'=> $data['price'],
            'unit_cost'=> $data['cost'],
        ];

        $product = $this->Products->newEntity($data, [
            'associated' => ['Stock']
        ]);

        if ($this->Products->save($product)) {
            $message = 'Success';
        } else {
            $message = [
                'message' => 'Error',
                'log' => $product->errors(),
                'request' => $this->request
            ];
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function put($id) {
        $product = $this->Products->get($id);
        if ($this->request->is(['post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $message = 'Success';
            } else {
                $message = [
                    'message' => 'Error',
                    'log' => $product->errors()
                ];
            }
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        $this->Products->delete($product);
        
        $this->set([
            'message' => 'ok',
            '_serialize' => ['message']
        ]);
    }
}
