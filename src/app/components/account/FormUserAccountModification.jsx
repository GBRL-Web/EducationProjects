import React from 'react';
import DatePicker from "react-datepicker";
import axios from "axios";
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import "react-datepicker/dist/react-datepicker.css";
import DeleteButton from '../../shared/components/utils-components/DeleteButton';
import { URL_HOME } from './../../shared/constants/urls/urlConstants';
import { useHistory } from 'react-router-dom';



export default class FormUserAccountModification extends React.Component {

    state = {
        id: '',
        name: '',
        birthDate: '',
        username: '',
        phoneNumber: '',
        email: '',
        password: '',
        passwordConfirm: '',
    };

    handleChangeDate = (e, setFieldValue) => {
        setFieldValue("birthDate", e)
    };


    componentDidMount() {

        const api = 'https://127.0.0.1:8000/api/user/account/getoken';

        const token = localStorage.getItem('token');

        setTimeout(() => {
            axios.get(api, { headers: { "Authorization": `${token}` } })
                .then(res => {
                    this.setState({
                        id: res.data.id,
                        name: res.data.name,
                        username: res.data.username,
                        phoneNumber: res.data.telephone,
                        email: res.data.email,
                        birthDate: new Date(res.data.birth_date.date),
                    })

                })
                .catch((error) => {
                    console.log(error)
                });

        }, 1000);

    }

    SignupSchema() {
        return Yup.object().shape({
            name: Yup.string()
                .min(2, 'Too Short!')
                .max(50, 'Too Long!')
                .required('Required'),
            username: Yup.string()
                .min(2, 'Too Short!')
                .max(50, 'Too Long!')
                .required('Required'),
            password: Yup.string()
                .required('Please Enter your password')
                .matches(
                    /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/,
                    "Must Contain 8 Characters, One Uppercase, One Lowercase, One Number and One Special Case Character"
                ),
            passwordConfirm: Yup.string()
                .label('Password Confirm')
                .required()
                .oneOf([Yup.ref('password')], 'Passwords does not match'),
            birthDate: Yup.date()
                .required('Required'),
            phoneNumber: Yup.string()
                .required('Required')
                .matches(/^[0-9]+$/, "Must be only digits")
                .min(10, 'Must be exactly 10 digits')
                .max(10, 'Must be exactly 10 digits'),
            email: Yup.string().email('Invalid email').required('Required'),
        });
    }

    render() {

        return (

            <div className=" bg-[url('src/app/assets/images/street-art_retouchee.png')]  bg-cover bg-center h-screen   " >


                <Formik
                    enableReinitialize={true}
                    initialValues={{
                        id: this.state.id,
                        name: this.state.name,
                        username: this.state.username,
                        phoneNumber: this.state.phoneNumber,
                        email: this.state.email,
                        birthDate: this.state.birthDate,
                        password: '',
                        is_active: '',
                    }}
                    validationSchema={this.SignupSchema}
                    onSubmit={(values) => {
                        const user = {
                            id: values.id,
                            name: values.name,
                            username: values.username,
                            phoneNumber: values.phoneNumber,
                            email: values.email,
                            birthDate: values.birthDate,
                            password: values.password,
                            is_active: true
                        };


                        axios.post("https://127.0.0.1:8000/api/user/account/modification", user)
                            .then((res) => {

                                if (res.status === 200 && res.data.id_token) {
                                    localStorage.setItem('token', res.data.id_token);
                                    window.open("http://localhost:3000", "_self");

                                }

                            })
                            .catch((err) => {
                                console.error(err);
                            });


                    }



                    }

                >

                    {({ setFieldValue, values }) => (
                        <Form>
                            <h1 className='text-center text-xl mb-5 pt-8 text-white	font-extrabold'>Modification de votre compte</h1>
                            <div className="mt-10 sm:mt-0 flex text-center justify-center">
                                <div className="md:grid  md:gap-7">
                                    <div className="mt-5 md:mt-0 md:col-span-2">
                                        <div className="grid grid-cols-6 gap-6">

                                            <div className="col-span-6 sm:col-span-3">
                                                <Field
                                                    type="text"
                                                    name="name"
                                                    placeholder="name"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey placeholder-white"
                                                />
                                                <ErrorMessage
                                                    name="name"
                                                    component="small"
                                                    className="text-white"
                                                />


                                            </div>

                                            <div className="col-span-6 sm:col-span-3">
                                                <Field
                                                    type="text"
                                                    placeholder="username"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey	placeholder-white  "
                                                    name="username"
                                                />
                                                <ErrorMessage
                                                    name="username"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>


                                            <div className="col-span-6 sm:col-span-3">

                                                <Field
                                                    type="email"
                                                    placeholder="email"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey	placeholder-white  "
                                                    name="email"
                                                />
                                                <ErrorMessage
                                                    name="email"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>


                                            <div className="col-span-6 sm:col-span-3">
                                                <Field
                                                    type="text"
                                                    placeholder="phoneNumber"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey	placeholder-white  "
                                                    name="phoneNumber"
                                                />
                                                <ErrorMessage
                                                    name="phoneNumber"
                                                    component="small"
                                                    className="text-white"
                                                />
                                            </div>

                                            <div className="col-span-6 sm:col-span-3">

                                                <DatePicker
                                                    name='birthDate'
                                                    selected={values.birthDate}
                                                    onChange={(e) => {
                                                        this.handleChangeDate(e, setFieldValue)
                                                    }}
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey	text-white  "

                                                />

                                                <ErrorMessage
                                                    name="birthDate"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>



                                            <div className="col-span-6 sm:col-span-3">
                                                <Field
                                                    name="password"
                                                    type="password"
                                                    placeholder="password"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey	placeholder-white  "

                                                />

                                                <ErrorMessage
                                                    name="password"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>

                                            <div className="col-span-6 sm:col-span-3">
                                                <Field
                                                    name="passwordConfirm"
                                                    type="password"
                                                    placeholder=" Confirmation password"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey	placeholder-white  "

                                                />

                                                <ErrorMessage
                                                    name="passwordConfirm"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>




                                            <div className=" col-span-6 px-4 py-3 text-right sm:px-6 inline-flex justify-center">
                                                <button
                                                    type="submit"
                                                    className="w-96 py-2 px-4 border border-transparent bg-teal-400 font-extrabold		"
                                                >
                                                    S'enregistrer
                                                </button>

                                            </div>

                                            <div className=" col-span-6 px-4 py-3 text-right sm:px-6 inline-flex justify-center">



                                                <Field
                                                    component={() => {
                                                        return (
                                                            <DeleteButton id={values.id} />
                                                        )
                                                    }}
                                                />


                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                        </Form>
                    )}
                </Formik >


            </div >

        )
    }
}

