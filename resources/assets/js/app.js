require("./bootstrap");

import React from "react";
import ReactDOM from "react-dom";

import Home from "./components/Home";

if (document.getElementById("app")) {
    ReactDOM.render(<Home />, document.getElementById("app"));
}
