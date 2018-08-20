import {
    FETCH_USER_LIST,
    REQUEST_USER_LIST,
    RECEIVE_USER_LIST
} from "../actions/types";
const initialState = {
    userList: [],
    userAccessToken: ""
};

export default (state = initialState, action) => {
    switch (action.type) {
        case FETCH_USER_LIST:
            return {
                ...state,
                userList: action.payload
            };
        case REQUEST_USER_LIST:
            return {
                ...state,
                userAccessToken: action.payload
            };
        case RECEIVE_USER_LIST:
            return {
                ...state,
                userList: action.payload
            };
        default:
            return state;
    }
};
