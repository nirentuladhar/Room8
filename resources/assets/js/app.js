require("./bootstrap");

import React from "react";
import ReactDOM from "react-dom";

//import Home from "./components/Home";
import Root from "./Root";
import store from "./store/store";
import { Provider } from "react-redux";

if (document.getElementById("app")) {
    ReactDOM.render(
        <Provider store={store}>
            <Root />
        </Provider>,
        document.getElementById("app")
    );
}
