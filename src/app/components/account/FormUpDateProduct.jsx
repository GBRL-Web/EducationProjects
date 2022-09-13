/* eslint-disable prettier/prettier */
/* eslint-disable react/jsx-key */
import React from 'react';
import axios from 'axios';
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import ProductCard from '../../shared/components/container/ProductCard';

export default class FormUpDateProduct extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            products: {},
        };
    }

    getProducts() {
        axios
            .get(`https://127.0.0.1:8000/api/product/`)
            .then((res) => {
                console.log(typeof res.data);
                this.setState({
                    products: res.data,
                });
            })
            .catch((error) => console.log(error));
    }

    componentDidMount() {
        this.getProducts();
    }
    render() {


        return (
            <div>
                {Object.entries(this.state.products).map(([key, value]) => {
                    return (

                        <ProductCard key={key} id={value.id} name={value.name} imglink={value.imglink} />

                    )
                })}

            </div>
        );
    }
}
