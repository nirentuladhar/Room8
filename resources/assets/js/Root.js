import React from "react";
import UserList from "./components/UserList";

class Root extends React.Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col col-sm-12">
                        <UserList />
                    </div>
                </div>
            </div>
        );
    }
}

export default Root;
