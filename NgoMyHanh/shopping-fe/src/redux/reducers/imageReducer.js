import { ActionTypes } from "../contants/action-types";

const initialState = {
    images: [],
};

export const imageReducer = (state = initialState,{type, payload}) => {
    switch (type) {
        case ActionTypes.SET_IMAGES:
            return {...state, images: payload };
        default:
            return state;
    }
}


export const addImageReducer = (state = initialState,{type, payload}) => {
    switch (type) {
        case ActionTypes.ADD_IMAGE:
            return {...state, ...payload };
        default:
            return state;
    }
}

export const removeSelectedReducer = (state = initialState,{type, payload}) => {
    switch (type) {
        case ActionTypes.REMOVE_SELECTED_IMAGE:
            return {...state, ...payload };
        default:
            return state;
    }
}