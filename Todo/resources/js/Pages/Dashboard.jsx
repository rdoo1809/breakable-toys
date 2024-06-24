import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head} from '@inertiajs/react';
import ValidForm from "@/Components/InputHinter.jsx";
import InputHinter from "@/Components/InputHinter.jsx";
import InputLabel from "@/Components/InputLabel.jsx";

export default function Dashboard({auth}) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">You're logged in!</div>
                    </div>
                </div>
            </div>

            <div className="w-full ml-5">
                <InputLabel htmlFor="dynamic-input" value="Dynamic Input"/>
                <InputHinter id="dynamic-input" name="" type="text" className="mt-1 block w-6/12"/>
            </div>

        </AuthenticatedLayout>
    );
}
