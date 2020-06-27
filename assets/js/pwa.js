import React from "react";
import ReactDOM from "react-dom";

export default function Pwa() {
    console.log('pwa');
    return (
        <>
            <h1>PWA</h1>
        </>
    )
}

const rootElement = document.getElementById('pwa');

ReactDOM.render(
    <Pwa/>,
    rootElement
);
