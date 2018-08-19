require("./bootstrap");

import React from "react";
import ReactDOM from "react-dom";

//import Home from "./components/Home";
import UserList from "./components/UserList";

if (document.getElementById("app")) {
    ReactDOM.render(<UserList />, document.getElementById("app"));
}
