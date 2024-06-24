import React, {useState} from 'react';
import clsx from "clsx";

const MIN_LENGTH = 3;
const hasUppercase = (str) => /[A-Z]/.test(str);

//todo
//write tests to validate input hinter works correctly

const InputHinter = ({className = '', name = '', type = 'text', ref}) => {
    const [input, setInput] = useState('');
    const [touched, setTouched] = useState(false);
    const [errors, setErrors] = useState({});
    const inputTitle = name.length === 0 ? 'Field' : name;

    const validate = (value) => {
        const errors = {};
        if (!value) {
            errors.required = `${inputTitle} is REQUIRED`;
        } else if (value.length < MIN_LENGTH) {
            errors.minlength = `${inputTitle} must be at least ${MIN_LENGTH} CHARACTERS`;
        } else if (!/[A-Z]/.test(value)) {
            errors.uppercase = `${inputTitle} must contain at least one uppercase letter`;
        }
        return errors;
    };

    const handleChange = (e) => {
        setInput(e.target.value);
        setErrors(validate(e.target.value));
    };

    const handleBlur = () => {
        setTouched(true);
        setErrors(validate(input));
    };

    const errorClass = errors.required || errors.minlength || errors.uppercase ? 'input-error' : '';

    return (
        <div>
            <input
                type={type}
                value={input}
                onChange={handleChange}
                onBlur={handleBlur}
                className={clsx('border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm', errorClass, className)}
            />
            {touched && (errors.required || errors.minlength || errors.uppercase) && (
                <div>
                    {errors.required && <small className="text-danger">{errors.required}</small>}
                    {errors.minlength && <small className="text-danger">{errors.minlength}</small>}
                    {errors.uppercase && <small className="text-danger">{errors.uppercase}</small>}
                </div>
            )}
        </div>
    );
};

export default InputHinter;
