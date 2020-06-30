import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import ajax from "./utils/ajax";
import PlateAPI from "./api/PlateAPI";
import FileAPI from "./api/FileAPI";

class Plate {
    constructor(label, type, price) {
        this.label = label;
        this.type = type;
        this.price = price;
    }
}

export default function Pwa() {
    const [plate, setPlate] = useState(
        new Plate('Sandwich de saison', 'SANDWICH', 9.5)
    );
    const [file, setFile] = useState(null);
    const [files, setFiles] = useState([]);
    const [message, setMessage] = useState(null);
    const [plates, setPlates] = useState([]);
    const [loader, setLoader] = useState(false);

    useEffect(() => {
        console.log('plate changed: ',plate);
    },[plate]);

    useEffect(() => {
        loadPlates();
    },[]);

    useEffect(() => {
        //readFile()
    },[files]);

    const loadPlates = async () => {
        try {
            const plates = await PlateAPI.getAll();
            setPlates(plates);
        } catch (e) {
            console.log('err',e);
        }
    }

    const handleChange = ({ currentTarget }) => {
        const {name, value} = currentTarget;
        console.log(name,value);
        setPlate({...plate, [name]: value});
    }

    const handleFile = event => {
        console.log(event.target.files[0]);
        setFile(event.target.files[0]);
        readFile(event.target, 'file_to_upload');
        //const status = FileAPI.createFile(data);
    }

    const handleFiles = event => {
        console.log(event.target.files);
        const localFiles = event.target.files;
        setFiles(localFiles);
        localFiles.forEach(function (file) {
            //const filesContainer = document.getElementById("files_to_upload");
            //const img = document.createElement("IMG");
            //filesContainer.append(img);
            readFile(event.target, 'files_to_upload');
        })
    }

    const handleSubmit = event => {
        event.preventDefault();
        createPlate();
    }

    const createPlate = () => {
        let formData = new FormData();
        formData.append('file',file);
        formData.append('plate',plate);
        for (let value of formData.values()) {
            console.log(value);
        }
        const ajaxInit = ajax.initAjax("POST", new Headers(), formData);
        const response = PlateAPI.create(ajaxInit);
    }

    const readFile = (input, targetPreview) => {
        console.log('input',input);
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let newPreview = document.getElementById(targetPreview);
                newPreview.setAttribute('src', e.target.result);
            }
            const base64 = reader.readAsDataURL(input.files[0]); // convert to base64 string
            console.log(base64);
        }
    }

    return (
        <>
            <h1>PWA</h1>
            <h2>{message?.toUpperCase()}</h2>
            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <fieldset>
                    <label htmlFor="label">LABEL</label>
                    <input onChange={handleChange} value={plate.label} name={"label"} type="text"/>
                </fieldset>
                <fieldset>
                    <label htmlFor="type">TYPE</label>
                    <select onChange={handleChange} name="type" id="type" value={plate.type}>
                        <option value="PLATE">Plate</option>
                        <option value="SANDWICH">Sandwich</option>
                    </select>
                </fieldset>
                <fieldset>
                    <label htmlFor="price">PRICE</label>
                    <input onChange={handleChange} value={plate.price} type="text" name={"price"}/>
                </fieldset>
                <fieldset>
                    <label htmlFor="file">IMAGE</label>
                    <input onChange={handleFile} name={"file"} type="file" id="file"/>
                </fieldset>
                {file && <img id={"file_to_upload"} src={"#"} alt={"Image"}/>}

                <button type="submit">Envoyer</button>
            </form>
            {loader && <p>Loading...</p>}
            {!loader &&
                plates?.map(plate => <p key={plate.id}>{plate.label}</p>)
            }
        </>
    )
}

const rootElement = document.getElementById('pwa');

ReactDOM.render(
    <Pwa/>,
    rootElement
);
