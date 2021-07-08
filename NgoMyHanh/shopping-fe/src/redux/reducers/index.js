import { combineReducers } from "redux";
import { productReducer,selectedProductReducer } from "./productReducer";
import { typeReducer, selectedTypeReducer } from "./typeReducer";

const reducers = combineReducers({
    allProducts : productReducer,
    product     : selectedProductReducer,
    allTypes    : typeReducer,
    type        : selectedTypeReducer

})

export default reducers;