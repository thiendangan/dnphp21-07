import React,{lazy,Suspense} from 'react';
import {BrowserRouter as Router,Switch,Route} from 'react-router-dom';

const Product = lazy(() => import('./components/Product.js'));
const HomePage = lazy(() => import('./pages/HomePage.js'));
const ManagementProduct = lazy(() => import('./pages/ManagementProduct.js'));

const ProductList = lazy(() => import('./product/ProductList.js'));
const ProductDetail = lazy(() => import('./product/ProductDetail.js'));

const ProductsTable = lazy(() => import('./admin/product/ProductsTable.js'));

const App = () => {
  return (
    <Router>
      <Suspense fallback={<div>Loading...</div>}>      
      <Switch>
        <Route exact path='/about' component={Product}/>
        <Route exact path='/home'  component={HomePage}/>
        <Route exact path='/management'  component={ManagementProduct}/>
        <Route exact path='/list-product'  component={ProductList}/>
        <Route exact path='/product/:id'  component={ProductDetail}/>

        <Route exact path='/product-management'  component={ProductsTable}/>
      </Switch>
      </Suspense>
    </Router>
  );
}


export default App;