import React,{lazy,Suspense} from 'react';
import {BrowserRouter as Router,Switch,Route} from 'react-router-dom';
import Header from './share/Header.js';


const ProductList = lazy(() => import('./product/ProductList.js'));
const ProductDetail = lazy(() => import('./product/ProductDetail.js'));

const ProductManagement = lazy(() => import('./admin/product/ProductManagement.js'));
const UpdateProduct = lazy(() => import('./components/product/UpdateProduct.js'));

const App = () => {
  return (
    
    <Router>
      
      <Suspense fallback={<div>Loading...</div>}>  
      <Header/>    
      <Switch>
        <Route exact path='/product/edit/:id' component={UpdateProduct}/>
        <Route exact path='/'  component={ProductList}/>
        <Route exact path='/product/:id'  component={ProductDetail}/>

        <Route exact path='/product-management'  component={ProductManagement}/>
      </Switch>
      </Suspense>
    </Router>
  );
}


export default App;