import { FETCH_USER_LIST, REQUEST_USER_LIST, RECEIVE_USER_LIST } from "./types";
import store from "../store/store";

export const fetchUserList = (url, credentials) => dispatch => {
    axios.post(url + "auth/login", credentials).then(response => {
        dispatch({
            type: REQUEST_USER_LIST,
            payload: response.data.token_type + " " + response.data.access_token
        });
        return receiveUserList(url, dispatch);
    });
};

const receiveUserList = (url, dispatch) => {
    axios
        .get(url + "test/users", {
            headers: {
                Authorization: store.getState().dummyReducer.userAccessToken
            }
        })
        .then(response =>
            dispatch({
                type: RECEIVE_USER_LIST,
                payload: response.data
            })
        );
};
