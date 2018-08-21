import { FETCH_USER_LIST, REQUEST_USER_LIST, RECEIVE_USER_LIST } from "./types";

export const fetchUserList = (url, credentials) => dispatch => {
    axios
        .post(url + "auth/login", credentials)
        .then(res => {
            const accessToken = res.data.token_type + " " + res.data.access_token;
            dispatchAccessToken(accessToken, dispatch);
            return axios.get(url + "test/users", {
                headers: { Authorization: accessToken }
            });
        })
        .then(response => dispatchUserList(response.data, dispatch))
        .catch(error => console.log(error));
};

const dispatchUserList = (userList, dispatch) => {
    dispatch({
        type: RECEIVE_USER_LIST,
        payload: userList
    });
};
const dispatchAccessToken = (accessToken, dispatch) => {
    dispatch({
        type: REQUEST_USER_LIST,
        payload: accessToken
    });
};
