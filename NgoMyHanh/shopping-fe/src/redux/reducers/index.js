import { combineReducers } from "redux";
import { productReducer,selectedProductReducer,addProductReducer } from "./productReducer";
import { typeReducer, selectedTypeReducer } from "./typeReducer";
import { subTypeReducer, selectedSubTypeReducer } from "./subTypeReducer";
import { addImageReducer, imageReducer, removeSelectedReducer } from "./imageReducer";


const reducers = combineReducers({
    allProducts     : productReducer,
    product         : selectedProductReducer,
    addProduct      : addProductReducer,

    allTypes        : typeReducer,
    type            : selectedTypeReducer,

    allSubTypes     : subTypeReducer,
    subType         : selectedSubTypeReducer,

    allImages       : imageReducer,
    addImage        : addImageReducer,
    image           : removeSelectedReducer,

})

export default reducers;