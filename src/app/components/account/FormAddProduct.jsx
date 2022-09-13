import React from 'react';
import axios from 'axios';
import { Formik, Field, Form, ErrorMessage, useField } from 'formik';
import * as Yup from 'yup';

const MyTextArea = ({ label, ...props }) => {
    // useField() returns [formik.getFieldProps(), formik.getFieldMeta()]
    // which we can spread on <input> and alse replace ErrorMessage entirely.
    const [field, meta] = useField(props);
    return (
        <>
            <label htmlFor={props.id || props.name}>{label}</label>
            <textarea className="text-area" {...field} {...props} />
            {meta.touched && meta.error ? (
                <div className="error text-red-500">{meta.error}</div>
            ) : null}
        </>
    );
};

const vadilSchema = Yup.object().shape({
    name: Yup.string().min(5, 'Too Short!').max(15, 'Too Long!').required('Required'),
    tag: Yup.string().min(5, 'Too Short!').max(20, 'Too Long!').required('Required'),
    description: Yup.string()
        .min(10, 'Too Short!')
        .max(1000, 'Too Long!')
        .required('Required'),
    color: Yup.string().min(4, 'Too Short!').max(10, 'Too Long!').required('Required'),
    material: Yup.string().min(5, 'Too Short!').max(20, 'Too Long!').required('Required'),
    brand: Yup.string().min(5, 'Too Short!').max(20, 'Too Long!').required('Required'),
    quantity: Yup.string()
        .min(1, 'Min value 1')
        .max(3, 'Max value 999')
        .required('Required')
        .matches(/^[0-9]+$/, 'ne doit etre que des chiffres'),
    price: Yup.string()
        .min(1, 'Min value 1')
        .max(8, 'Max value 999')
        .required('Required')
        .matches(/^[0-9].+$/, 'ne doit etre que des chiffres'),
    imglink: Yup.string().min(10, 'Too Short!').max(50, 'Too Long!').required('Required'),
});

export default class FormAddProduct extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            name: '',
            tag: '',
            description: '',
            color: '',
            weight: {},
            material: '',
            brand: 'Brakka',
            quantity: '',
            price: '',
            imglink: '',
            category: {},
        };
    }

    getCategory() {
        axios
            .get(`https://127.0.0.1:8000/api/send-category/`)
            .then((res) => {
                //console.log(typeof res.data);
                this.setState({
                    category: res.data,
                });
                //console.log(this.state.category);
            })
            .catch((error) => console.log(error));
    }
    getSize() {
        axios
            .get(`https://127.0.0.1:8000/api/size`)
            .then((res) => {
                console.log(typeof res.data);
                this.setState({
                    weight: res.data,
                });
                console.log(this.state.weight);
            })
            .catch((error) => console.log(error));
    }

    componentDidMount() {
        this.getCategory();
        this.getSize();
    }

    // componentDidUpdate() {}

    render() {
        return (
            <div className="bg-[url('src/app/assets/images/frida-retouchee.png')] bg-cover bg-center h-full">
                <Formik
                    initialValues={{
                        name: '',
                        tag: '',
                        description: '',
                        color: '',
                        weight: '1',
                        material: '',
                        brand: 'Braka',
                        quantity: '',
                        price: '',
                        imglink: '',
                        category: '1',
                    }}
                    validationSchema={vadilSchema}
                    onSubmit={(values) => {
                        console.log(values);
                        const product = {
                            name: values.name,
                            tag: values.tag,
                            description: values.description,
                            color: values.color,
                            weight: values.weight,
                            material: values.material,
                            brand: values.brand,
                            quantity: values.quantity,
                            price: values.price,
                            imglink: values.imglink,
                            category: values.category,
                        };
                        axios
                            .post(`https://127.0.0.1:8000/add-product/`, product)
                            .then((res) => {
                                console.log(res.data);
                            })

                            .catch((err) => {
                                console.error(err);
                            });
                    }}
                >
                    {() => (
                        <Form className="text-center">
                            <h1 className="text-white font-bold text-center font-roboto pt-4 mb-4">
                                Section Commerciale
                            </h1>

                            {/* ici va se trouver la barre de navigation */}
                            <div className="flex justify-center text-center">
                                <div className="col-span-2">
                                    <div className="grid grid-cols-2 lg:gap-y-10 lg:gap-x-40">
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="name"
                                            >
                                                Name
                                            </label>
                                            <Field
                                                type="text"
                                                name="name"
                                                placeholder="name"
                                                className=" bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="name"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="category"
                                            >
                                                Catégorie
                                            </label>
                                            <Field
                                                name="category"
                                                as="select"
                                                className="bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            >
                                                {Object.entries(this.state.category).map(([key, value]) => {
                                                    return <option key={key} value={value.id}>{value.name}</option>;
                                                })}
                                            </Field>
                                            <ErrorMessage
                                                name="category"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="tag"
                                            >
                                                Tag
                                            </label>
                                            <Field
                                                type="text"
                                                name="tag"
                                                placeholder="tag"
                                                className="bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="tag"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="color"
                                            >
                                                Color
                                            </label>
                                            <Field
                                                type="text"
                                                name="color"
                                                placeholder="color"
                                                className="bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="color"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="weight"
                                            >
                                                Weight
                                            </label>
                                            <Field
                                                placeholder="40"
                                                name="weight"
                                                as="select"
                                                className="bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            >
                                                {Object.entries(this.state.weight).map(([key, value]) => {
                                                    return <option key={key} value={value.id}>{value.name}</option>;
                                                })}
                                            </Field>
                                            <ErrorMessage
                                                name="weight"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="material"
                                            >
                                                Material
                                            </label>
                                            <Field
                                                type="text"
                                                name="material"
                                                placeholder="material"
                                                className="bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="material"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="brand"
                                            >
                                                Brand
                                            </label>
                                            <Field
                                                type="text"
                                                name="brand"
                                                placeholder="brand"
                                                className="bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="brand"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="quantity"
                                            >
                                                Quantity
                                            </label>
                                            <Field
                                                type="text"
                                                name="quantity"
                                                placeholder="quantity"
                                                className="bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="quantity"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="price"
                                            >
                                                Price
                                            </label>
                                            <Field
                                                type="text"
                                                name="price"
                                                placeholder="price"
                                                className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="price"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                        <div className="grid grid-rows-2">
                                            <label
                                                className="font-roboto text-white"
                                                htmlFor="imglink"
                                            >
                                                Imglink
                                            </label>
                                            <Field
                                                type="text"
                                                name="imglink"
                                                placeholder="image link"
                                                className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                            />
                                            <ErrorMessage
                                                name="imglink"
                                                component="small"
                                                className="text-red-500"
                                            />
                                        </div>
                                    </div>
                                    <div className="mt-20">
                                        <label
                                            className="font-roboto text-white"
                                            htmlFor="description"
                                        >
                                            Description
                                        </label>
                                        <MyTextArea
                                            type="text"
                                            name="description"
                                            as="textarea"
                                            placeholder="description"
                                            className="w-full h-48 bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                        />
                                    </div>
                                </div>
                            </div>

                            <button
                                className="bg-[#00CBD3] mt-20 w-1/4 font-bold mb-8"
                                type="submit"
                            >
                                Submit
                            </button>
                        </Form>
                    )}
                </Formik>
            </div>
        );
    }
}
