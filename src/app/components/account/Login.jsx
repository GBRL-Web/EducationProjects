import { Field, Form, Formik } from 'formik';
import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { Link, useHistory } from 'react-router-dom';

import Input from '../../shared/components/form-and-error-components/Input';
import { signIn } from '../../shared/redux-store/authenticationSlice';
import { isAuthenticated } from '../../shared/services/accountServices';
import { authenticate } from './../../api/backend/account';
import ErrorMessSmall from './../../shared/components/form-and-error-components/ErrorMessSmall';
import { Checkbox } from './../../shared/components/form-and-error-components/InputChoices';
import { defaulValuesLogin } from './../../shared/constants/formik-yup/default-values-form/idefaultValuesUser';
import { schemaFormLogin } from './../../shared/constants/formik-yup/yup/yupUser';
import { URL_HOME } from './../../shared/constants/urls/urlConstants';

/**
 * Component Form Login
 * Use Formik to create the Form
 *
 * @param {function} submit: submit Function
 * @param {object} initialValues: the initial values of the form
 * @param {boolean} errorLog: to display or not the message of login/mdp not valid
 * @param {object} validationSchema: validation's schema of the form
 * @author Peter Mollet
 */

const FormLogin = ({ submit, errorLog }) => (
    <Formik
        initialValues={defaulValuesLogin}
        onSubmit={submit}
        validationSchema={schemaFormLogin}
    >
        <Form className="mt-8 space-y-6">
            <div className="">
                <Field
                    type="text"
                    name="username"
                    placeholder="Email"
                    component={Input}
                    className="bg-transparent rounded-none text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey placeholder-white"
                    noError
                />
                <Field
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    component={Input}
                    className="bg-transparent pt-10	rounded-none text-white border-t-0 border-l-0 border-r-0 border-b-4 border-grey placeholder-white"
                    noError
                />
            </div>

            <div className="flex items-center justify-between ">
                <Field
                    name="rememberMe"
                    label="Remember me"
                    component={Checkbox}
                    value={true}
                />
                <div className="text-sm">
                    <Link to="/forgot-password">
                        <span className="font-medium text-teal-400 hover:text-primary cursor-pointer">
                            Mot de passe oublié ?
                        </span>
                    </Link>
                </div>
            </div>

            <div className="inline-flex justify-center  col-span-6 px-4 py-3 text-right sm:px-6 ">
                <button
                    type="submit"
                    className="w-80 py-2 px-4 border border-transparent bg-teal-400 font-extrabold"
                >
                    Connexion
                </button>
            </div>
            {errorLog && <ErrorMessSmall middle message="Login/Password incorrect(s)" />}
        </Form>
    </Formik>
);

/**
 * Component Login
 *
 * will need in props:
 *  - Submit Function
 *  - errorLog boolean
 *  - validationSchema
 *
 * See above for information
 *
 * @author Peter Mollet
 */
const Login = () => {
    const [errorLog, setErrorLog] = useState(false);
    const dispatch = useDispatch();
    const history = useHistory();
    const handleLogin = (values) => {
        authenticate(values)
            .then((res) => {
                if (res.status === 200 && res.data.id_token) {
                    dispatch(signIn(res.data.id_token));
                    if (isAuthenticated()) history.push(URL_HOME);
                    else {
                        window.open('https://localhost:3000/register');
                    }
                }
            })
            .catch(() => setErrorLog(true));
    };

    return (
        <div className="p-4 rounded-md shadow max-w-md w-full space-y-8 py-12 px-4 sm:px-6 lg:px-8">
            <div>
                <div className="flex justify-center"></div>
                <h2 className="mt-6 text-center text-2xl font-extrabold text-white">
                    Vous avez déjà un compte ?
                </h2>
            </div>

            <hr />
            <FormLogin errorLog={errorLog} submit={handleLogin} />
        </div>
    );
};

export default Login;
