import axios from 'axios';
import { Field, Form, Formik } from 'formik';
import React from 'react';
import * as Yup from 'yup';

// Define validation schema for the form with Yup

const validateSchema = Yup.object().shape({
    name: Yup.string()
        .min(2, 'Too short')
        .max(50, 'Too long')
        .required('Please enter your name.'),
    email: Yup.string()
        .email('Invalid email address')
        .required('Required. Please enter a valid email address'),
    message: Yup.string().required(
        "We appreciate the thought, but we'd love to hear from you!",
    ),
});

// Initiating Contact class with default properties - Defining message as a Contact class object.
export default class ContactView extends React.Component {
    render() {
        return (
            <div className="px-32 py-36 overflow-hidden h-full bg-[url('/src/app/assets/images/street-art_retouchee.png')]">
                <div className="container">
                    {/* Contact info area */}
                    <div className="flex flex-wrap lg:justify-between -mx-4 bg-white/20 py-5">
                        <div className="w-full lg:w-1/2 xl:w-6/12 px-4 nor-font">
                            <div className="max-w-[570px] mb-12 lg:mb-0">
                                <span className="block mb-4 text-base text-teal-200 font-semibold">
                                    Contact Us
                                </span>

                                <h2
                                    className="
                        text-dark
                        mb-6
                        uppercase
                        font-bold
                        text-[32px]
                        
                        text-white
                        sm:text-[40px]
                        lg:text-[36px]
                        xl:text-[40px]
                        "
                                >
                                    GET IN TOUCH WITH US
                                </h2>
                                <p className="text-base text-white leading-relaxed mb-9">
                                    Send us a message about any website/product related
                                    issue you had.
                                </p>
                            </div>
                        </div>

                        <div className="w-full lg:w-1/2 xl:w-5/12 px-4">
                            <Formik
                                initialValues={{ name: '', email: '', message: '' }}
                                validationSchema={validateSchema}
                                onChange={this.handleChange}
                                onSubmit={(values) => {
                                    console.log(values);
                                    // Save input fields into a constant object
                                    const message = {
                                        name: values.name,
                                        email: values.email,
                                        message: values.message,
                                    };

                                    // Axios send message through POST request
                                    axios
                                        .post(
                                            'https://localhost:8000/api/message/new',
                                            message,
                                        )
                                        .then((res) => {
                                            console.log(res.data);
                                            let data = [message];
                                            data.push(res.data.message);
                                            this.setState({
                                                message: data,
                                            });
                                        })
                                        .catch((err) => {
                                            console.error(err);
                                        });
                                }}
                            >
                                {({ errors, touched }) => (
                                    <Form className="relative p-8 sm:p-12">
                                        <Field
                                            name="name"
                                            type="text"
                                            placeholder="Full Name"
                                            className="
                            w-full
                            
                            py-3
                            px-[14px]
                            text-body-color text-base
                            border border-[f0f0f0]
                            outline-none
                            focus-visible:shadow-none
                            focus:border-primary
                            "
                                        />
                                        {errors.name && touched.name ? (
                                            <div>{errors.name}</div>
                                        ) : null}
                                        <Field
                                            name="email"
                                            type="email"
                                            placeholder="Email..."
                                            className="
                            w-full
                            py-3
                            px-[14px]
                            text-body-color text-base
                            border border-[f0f0f0]
                            outline-none
                            focus-visible:shadow-none
                            focus:border-primary
                            "
                                        />
                                        {errors.email && touched.email ? (
                                            <div>{errors.email}</div>
                                        ) : null}
                                        <Field
                                            name="message"
                                            component="textarea"
                                            type="text"
                                            placeholder="Your message..."
                                            rows="5"
                                            className="
                            w-full
                            
                            py-3
                            px-[14px]
                            text-body-color text-base
                            border border-[f0f0f0]
                            resize-none
                            outline-none
                            focus-visible:shadow-none
                            focus:border-primary
                            "
                                        />
                                        {errors.message && touched.message ? (
                                            <div>{errors.message}</div>
                                        ) : null}
                                        <button
                                            type="submit"
                                            className="w-full py-3 mt-10 bg-teal-400 font-medium text-white uppercase focus:outline-none nor-font hover:shadow-none"
                                        >
                                            Send Message
                                        </button>
                                    </Form>
                                )}
                            </Formik>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
