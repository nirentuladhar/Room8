import React, { Component } from "react";

export default class Home extends Component {
    constructor() {
        super();
        this.state = {
            count: 0
        };
        this.handleIncrement = this.handleIncrement.bind(this);
        this.handleDecrement = this.handleDecrement.bind(this);
    }
    handleIncrement() {
        let count = this.state.count;
        count++;
        this.setState({ count: count });
    }

    handleDecrement() {
        let count = this.state.count;
        count--;
        this.setState({ count: count });
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <h3 className="mt-4">Count: {this.state.count} </h3>
                        <button
                            onClick={this.handleIncrement}
                            className="btn btn-primary mr-2"
                        >
                            Add
                        </button>
                        <button
                            onClick={this.handleDecrement}
                            className="btn btn-secondary"
                        >
                            Subtract
                        </button>
                    </div>
                </div>
            </div>
        );
    }
}
