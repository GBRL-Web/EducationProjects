import React from 'react';

function LoginModal(props) {
    const { loginModal } = props;
    return (
        <div
            className="relative z-50"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <div className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div className="fixed z-10 inset-0 overflow-y-auto">
                <div className="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                    <div className="relative bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                        <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <button
                                className="absolute top-1 right-2"
                                onClick={loginModal}
                            >
                                X
                            </button>
                            <div className="sm:flex sm:items-start">
                                <div className="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-10 rounded-full animate-pulse bg-red-300 sm:mx-0 sm:h-10 sm:w-10">
                                    {/* <!-- Heroicon name: outline/exclamation --> */}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        className="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fillRule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clipRule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3
                                        className="text-lg leading-6 font-medium text-gray-900"
                                        id="modal-title"
                                    >
                                        Not logged in
                                    </h3>
                                    <div className="mt-2">
                                        <p className="text-sm text-gray-500">
                                            {/* eslint-disable-next-line */}
                                            You need to be logged in, or, if you don't
                                            have an account, create one to use the
                                            favorite function!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <a href="/login">
                                <button
                                    type="button"
                                    className="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-400 text-base font-medium text-white hover:bg-teal-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm"
                                >
                                    Login
                                </button>
                            </a>
                            <a href="/register">
                                <button
                                    type="button"
                                    className="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                >
                                    Create account
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default LoginModal;
