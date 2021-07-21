import { ActionTypes } from "../contants/action-types";

export const setImages = (images) => {
    return{
        type: ActionTypes.SET_IMAGES,
        payload:images,
    }
};

export const removeSelectedImage = (image) => {
    return{
        type: ActionTypes.REMOVE_SELECTED_IMAGE,
        payload:image,
    }
};

export const addImage = (image) => {
    return{
        type: ActionTypes.ADD_IMAGE,
        payload:image,
    }
};