import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { Head, Link, useForm } from '@inertiajs/react';
import { Header } from '@/components/header';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Button } from '@/components/ui/button';
import { ArrowLeft, Check, LoaderIcon } from 'lucide-react';
import { useToast } from '@/hooks/use-toast';

export default function Create() {
    const { toast } = useToast();

    const { data, setData, post, processing, errors } = useForm({
        name: '',
        description: '',

    });

    const storeData = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        post(route('apps.suppliers.store'), {
            onSuccess: () => {
                toast({
                    'variant': "success",
                    'title': "Success",
                    'description': 'Data Berhasil disimpan!',
                })
            },
        });
    }

    return (
        <>
            <Head title='Tambah Supplier' />
            <div className="w-full">
                <Header title='Tambah Data Kategori' subtitle='Halaman ini digunakan untuk menambah data supplier' />
                <div className="p-6">
                    <Card>
                        <CardHeader>
                            <CardTitle>Tambah Supplier</CardTitle>
                            <CardDescription>Form ini digunakan untuk menambahkan data Supplier</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="w-full">
                                <form onSubmit={storeData}>
                                    <div className="mb-4 flex-col gap-2">
                                        <Label>Nama Supplier <span className='text-rose-500'>*</span></Label>
                                        <Input type='text' value={data.name} onChange={(e) => setData('name', e.target.value)} placeholder='Masukan nama supplier' />
                                        <p className='text-red-500 text-xs'>{errors.name}</p>
                                    </div>
                                    <div className="mb-4 flex-col gap-2">
                                        <Label>Deskripsi</Label>
                                    </div>
                                </form>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </>
    )
}

Create.layout = (page: React.ReactNode) => <AppLayout children={page} />

