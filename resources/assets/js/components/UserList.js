import React from "react";

import axios from "axios";

export default class UserList extends React.Component {
    constructor() {
        super();
        this.state = {
            users: [],
            access_token: null
        };
    }

    componentDidMount() {
        //login a valid user from db first
        let url = "http://room8.test:8000/api/";
        var self = this;
        //send login post request to get access token
        axios
            .post(url + "auth/login", {
                email: "karine78@example.org",
                password: "secret"
            })
            .then(response => {
                self.setState({
                    access_token:
                        response.data.token_type +
                        " " +
                        response.data.access_token
                });
            })
            .finally(() => {
                axios
                .get(url+"test/users",{
                    headers: {
                        Authorization: self.state.access_token
                    }
                })
                .then(response => {
                    console.log(response);
                    self.setState({ users: response.data });
                });
            });

        
    }

    render() {
        return (
            <ul>
                {this.state.users.map(user => (
                    <li key={user.id}>{user.name}</li>
                ))}
            </ul>
        );
    }
}
