import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.jsx';
import InputError from '@/Components/InputError.jsx';
import PrimaryButton from '@/Components/PrimaryButton.jsx';
import {useForm, Head} from '@inertiajs/react';
import Todo from "@/Components/Todo.jsx";

export default function Index({ auth, items }) {
    const {data, setData, post, processing, reset, errors} = useForm({
        message: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('todos.store'), {onSuccess: () => reset()});
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Todos"/>

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <textarea
                        value={data.message}
                        placeholder="What will you accomplish today?"
                        className="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        onChange={e => setData('message', e.target.value)}
                    ></textarea>
                    <InputError message={errors.message} className="mt-2"/>
                    <PrimaryButton className="mt-4" disabled={processing}>Add to List</PrimaryButton>
                </form>

                <div className="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    {items.map(item =>
                        <Todo key={item.id} todo={item}/>
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
