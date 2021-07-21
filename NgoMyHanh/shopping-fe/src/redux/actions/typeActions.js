import { ActionTypes } from "../contants/action-types";

export const setTypes = (types) => {
    return{
        type: ActionTypes.SET_TYPES,
        payload:types,
    }
};

export const selectedType = (type) => {
    return{
        type: ActionTypes.SELECTED_TYPE,
        payload:type,
    }
};