import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import ajax from "./utils/ajax";
import PlateAPI from "./api/PlateAPI";
import jsonMenus from './config/menu.json';
import jsonTypes from './config/plateTypes.json';
import Plate from "./models/plate";
import Menu from "./models/menu";
import PlateForm from "./forms/plateForm";
import PlateType from "./models/plateType";
import 'bootstrap/dist/css/bootstrap.min.css';

export default function Pwa() {
    const [plate, setPlate] = useState({});
    const [plates, setPlates] = useState([]);
    const [plateTypes, setPlateTypes] = useState([]);
    const [menus, setMenus] = useState([]);
    const [file, setFile] = useState(null);
    const [base64File, setBase64File] = useState(null);
    const [message, setMessage] = useState(null);
    const [loader, setLoader] = useState(false);

    useEffect(() => {
        loadTypes();
        loadPlates();
        loadPlateForm();
        loadMenus();
    },[]);

    const loadPlates = async () => {
        try {
            const plates = await PlateAPI.getAll();
            console.log(plates);
            console.log(jsonMenus);
            setPlates(plates);
        } catch (e) {
            console.log('err',e);
        }
    }

    const loadPlateForm = () => {
        let newPlate = new Plate('Sandwich de saison', 'SANDWICH', 9.5);
        setPlate(newPlate);
    }

    const loadMenus = () => {
        const menus = jsonMenus.map(menu => {
            return new Menu(menu.id, menu.name, menu.promo, menu.price, menu.icon, menu.cat);;
        });
        console.log('menus',menus);
        setMenus(menus);
    }

    const loadTypes = () => {
        const types = jsonTypes.map(type => {
            return new PlateType(type.id, type.name, type.value);
        });
        setPlateTypes(types);
    }

    const handleChange = ({ currentTarget }) => {
        const {name, value} = currentTarget;
        console.log(name,value);
        setPlate({...plate, [name]: value});
    }

    const handleFile = event => {
        console.log(event.target.files[0]);
        setFile(event.target.files[0]);
        toBase64(event.target.files[0]);
        //readFile(event.target, 'file_to_upload');
    }

    const handleSubmit = async event => {
        event.preventDefault();
        await createPlate();
    }

    const createPlate = async () => {
        let formData = new FormData();
        formData.append('file',base64File);
        formData.append('label',plate.label);
        formData.append('type',plate.type);
        formData.append('price',plate.price);
        const ajaxInit = ajax.initAjax("POST", formData);
        const response = await PlateAPI.create(ajaxInit);
        console.log('create plate',response);
    }

    const readFile = (input, targetPreview) => {
        console.log('input',input);
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let newPreview = document.getElementById(targetPreview);
                newPreview.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        //reader.onload = () => console.log(reader.result);
        reader.onload = function(e) {
            let newPreview = document.getElementById("file_to_upload");
            newPreview.setAttribute('src', e.target.result);
            setBase64File(reader.result);
            console.log(reader.result);
        }
        reader.onerror = error => reject(error);
    });

    return (
        <div className="container">
            <h1>PWA</h1>
            <h2>{message?.toUpperCase()}</h2>
            <PlateForm
                handleSubmit={handleSubmit}
                handleChange={handleChange}
                handleFile={handleFile}
                plateTypes={plateTypes}
                file={file}
                plate={plate}
            />
            {loader && <p>Loading...</p>}
            {!loader &&
                menus?.map(menu => <p key={menu.id}>{menu.name}</p>)
            }
        </div>
    )
}

const rootElement = document.getElementById('pwa');

ReactDOM.render(
    <Pwa/>,
    rootElement
);
