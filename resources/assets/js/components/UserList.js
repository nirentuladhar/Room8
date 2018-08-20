import React from "react";
import axios from "axios";
import { connect } from "react-redux";

import { fetchUserList } from "../actions/userActions";

class UserList extends React.Component {
    componentDidMount() {
        //login a valid user from db first
        let url = "http://localhost:8000/api/";
        const credentials = {
            email: "yhirthe@example.net",
            password: "secret"
        };
        //send login post request to get access token
        this.props.fetchUserList(url, credentials);
    }

    render() {
        return (
            <div className="mt-5">
                <h2> Users </h2>
                <ul>
                    {this.props.userList.map(user => (
                        <li key={user.id}>{user.name}</li>
                    ))}
                </ul>
            </div>
        );
    }
}

const mapStateToProps = state => ({
    accessToken: state.dummyReducer.userAccessToken,
    userList: state.dummyReducer.userList
});

export default connect(
    mapStateToProps,
    { fetchUserList }
)(UserList);
