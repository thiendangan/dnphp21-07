import { ActionTypes } from "../contants/action-types";

const initialState = {
    subTypes: [],
};

export const subTypeReducer = (state = initialState,{type, payload}) => {
    switch (type) {
        case ActionTypes.SET_SUB_TYPES:
            return {...state, subTypes: payload };
        default:
            return state;
    }
}

export const selectedSubTypeReducer = (state = initialState,{type, payload}) => {
    switch (type) {
        case ActionTypes.SELECTED_SUB_TYPE:
            return {...state, ...payload };
        default:
            return state;
    }
}

