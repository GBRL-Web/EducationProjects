import React from 'react';
import DatePicker from "react-datepicker";
import axios from "axios";
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import moment from 'moment';
import "react-datepicker/dist/react-datepicker.css";


export default class FormAdmin extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            roles: [],
            date: moment().toDate()
        }
    }




    state = {
        show: false,
        roles: axios.get(`http://localhost:8000/api/roles`).then((res) => {
            this.setState({
                roles: res.data,
            });

        })
    }


    handleClose = () => {
        this.setState({ show: false });
    };
    handleShow = () => {
        this.setState({ show: true });
    };
    handleChangeDate = (date, event) => {
        this.setState({
            date
        });
        console.log(date);
    };

    handleChange = (err) => {
        this.setState({

        });
        console.log(err);
    };



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
            birthDate: Yup.date()
                .required('Required'),
            phoneNumber: Yup.string()
                .required('Required')
                .matches(/^[0-9]+$/, "Must be only digits")
                .min(10, 'Must be exactly 10 digits')
                .max(10, 'Must be exactly 10 digits'),
            email: Yup.string().email('Invalid email').required('Required'),
            id_role: Yup.string().required('Required')
        });
    }


    render() {

        const elements = this.state.roles;

        const items = [];


        for (const [index, value] of elements.entries()) {
            items.push(

                <option name="id_role" key={index} value={(index + 1)}>{value}</option>


            )
        }

        return (

            <div className=" bg-[url('/src/app/assets/images/street-art_retouchee.png')]  bg-cover bg-center h-screen  " >

                <Formik

                    initialValues={{
                        name: '',
                        username: '',
                        phoneNumber: '',
                        id_role: '1',
                        email: '',
                        birthDate: moment().toDate(),
                        password: '',
                        is_active: '',
                    }}

                    validationSchema={this.SignupSchema}
                    onChange={this.handleChange}
                    onSubmit={(values) => {
                        const user = {
                            name: values.name,
                            username: values.username,
                            id_role: values.id_role,
                            phoneNumber: values.phoneNumber,
                            email: values.email,
                            birthDate: values.birthDate,
                            password: values.password,
                            is_active: true
                        };

                        axios.post("http://127.0.0.1:8000/api/role/new", user)
                            .then((res) => {
                                let data = [user];
                                data.push(res.data.user);
                                this.setState({
                                    user: data,
                                });
                                if (res.status === 200) {
                                    window.open("http://localhost:3000/");

                                }
                            })
                            .catch((err) => {
                                console.error(err);
                            });


                    }
                    }
                >
                    {({ }) => (
                        <Form>
                            <h1 className='text-center text-xl mb-5 pt-8 text-white	font-extrabold'>Panel Admin
                            </h1>
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
                                                    name="username"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey placeholder-white"

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
                                                    name="email"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey placeholder-white"

                                                />
                                                <ErrorMessage
                                                    name="email"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>

                                            <div className="col-span-6 sm:col-span-3">

                                                <DatePicker
                                                    name='birthDate'
                                                    selected={this.state.date}
                                                    onChange={this.handleChangeDate}
                                                    maxDate={Date.now()}
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
                                                    name="id_role"
                                                    as="select"
                                                    className="bg-transparent text-white  focus-within:text-white focus-within:bg-black border-t-0 border-l-0 border-r-0 border-b-4 border-grey   "


                                                >


                                                    {items}

                                                </Field>

                                                <ErrorMessage
                                                    name="id_role"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>



                                            <div className="col-span-6 sm:col-span-3">
                                                <Field
                                                    type="text"
                                                    placeholder="phoneNumber"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey placeholder-white  "
                                                    name="phoneNumber"
                                                />
                                                <ErrorMessage
                                                    name="phoneNumber"
                                                    component="small"
                                                    className="text-white"
                                                />
                                            </div>



                                            <div className="col-span-6 sm:col-span-3">
                                                <Field
                                                    name="password"
                                                    type="password"
                                                    placeholder="password"
                                                    className="bg-transparent text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey placeholder-white"


                                                />

                                                <ErrorMessage
                                                    name="password"
                                                    component="small"
                                                    className="text-white"
                                                />

                                            </div>


                                            <div className=" col-span-6 px-4 py-3 text-right sm:px-6 inline-flex justify-center">
                                                <button
                                                    type="submit"
                                                    className="w-96 py-2 px-4 border border-transparent bg-teal-400 font-extrabold		"

                                                >
                                                    Créer un role
                                                </button>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </Form>

                    )}
                </Formik>



            </div >


        )
    }
}





