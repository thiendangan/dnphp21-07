import { ActionTypes } from "../contants/action-types";

export const setSubTypes = (subTypes) => {
    return{
        type: ActionTypes.SET_SUB_TYPES,
        payload:subTypes,
    }
};

export const selectedSubType = (subType) => {
    return{
        type: ActionTypes.SELECTED_SUB_TYPE,
        payload:subType,
    }
};

