import * as React from "react";

export default function PlateForm({ handleSubmit, handleChange, handleFile, plateTypes, plate, file }) {
    return (
        <form onSubmit={handleSubmit} method={"POST"} encType="multipart/form-data">
            <fieldset>
                <label htmlFor="label">LABEL</label>
                <input onChange={handleChange} value={plate.label} name={"label"} type="text"/>
            </fieldset>
            <fieldset>
                <label htmlFor="type">TYPE</label>
                <select onChange={handleChange} name="type" id="type" value={plate.type}>
                    {plateTypes.map(type => <option key={type.id} value={type.value}>{type.name}</option>)}
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
            <br/>
            <button type="submit" className={"btn btn-primary"}>Envoyer</button>
        </form>
    )
}
