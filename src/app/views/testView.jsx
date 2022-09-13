import React from 'react';
import axios from 'axios';
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';


export default class testview extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            name: '',
        };
    }

    handleSubmit = (values) => {

        // Save input fields into a constant object
        console.log(values);
        axios
            .post('https://127.0.0.1:8000/add-product/', values)
            .then((res) => {
                console.log(res.data);
            })

            .catch((err) => {
                console.error(err);
            });
    };

    render() {
        const vadilSchema = Yup.object().shape({
            name: Yup.string()
                .min(5, 'Too Short!')
                .max(15, 'Too Long!')
                .required('Required'),
        });

        return (
            <div className="bg-[url('src/app/assets/images/frida-retouchee.png')] bg-cover bg-center h-full">
                <h1>{this.state.name}</h1>

                <Formik
                    initialValues={{
                        name: this.state.name,
                    }}
                    validationSchema={vadilSchema}
                    onSubmit={this.handleSubmit}
                >
                    {() => (
                        <Form className="text-center">
                            <div className="flex justify-center text-center">
                                <Field
                                    type="text"
                                    name="name"
                                    placeholder="name"
                                    className=" bg-transparent border-t-0 border-l-0 border-r-0 border-b-4 border-white placeholder-white font-roboto text-[#00cbd3]"
                                   
                                   
                                />
                                <ErrorMessage
                                    name="name"
                                    component="small"
                                    className="text-white"
                                />
                            </div>
                            <button
                                className="bg-[#00CBD3] mt-20 w-1/4 font-bold"
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
