import { ActionTypes } from "../contants/action-types";

const initialState = {
    types: [],
};

export const typeReducer = (state = initialState,{type, payload}) => {
    switch (type) {
        case ActionTypes.SET_TYPES:
            return {...state, types: payload };
        default:
            return state;
    }
}

export const selectedTypeReducer = (state = initialState,{type, payload}) => {
    switch (type) {
        case ActionTypes.SELECTED_TYPE:
            return {...state, ...payload };
        default:
            return state;
    }
}