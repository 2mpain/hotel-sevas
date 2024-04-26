import { Header } from "@/Components/Header";
import { Button } from "@/Components/readyToUse/button";
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormMessage,
} from "@/Components/readyToUse/form";
import { Input } from "@/Components/readyToUse/input";
import { Textarea } from "@/Components/readyToUse/textarea";
import { zodResolver } from "@hookform/resolvers/zod";
import { router } from "@inertiajs/react";
import axios from "axios";
import { Component } from "lucide-react";
import React from "react";
import { useForm } from "react-hook-form";
import { z } from "zod";

interface ContactUsProps {
    setShowAlert: React.Dispatch<React.SetStateAction<boolean>>;
}

const ContactUs: React.FC<ContactUsProps> = ({ setShowAlert }) => {
    const formSchema = z.object({
        name: z
            .string()
            .min(2, {
                message: "Имя должно быть заполнено",
            })
            .max(20, {
                message: "Убедитесь в правильности ввода имени.",
            }),
        email: z
            .string()
            .min(1, { message: "Поле E-mail должно быть заполнено." })
            .email("E-mail введён некорректно"),
        message: z
            .string()
            .min(10, { message: "Пожалуйста, заполните Ваше сообщение." }),
    });

    const form = useForm<z.infer<typeof formSchema>>({
        resolver: zodResolver(formSchema),
        defaultValues: {
            name: "",
            email: "",
            message: "",
        },
    });

    function onSubmit(values: z.infer<typeof formSchema>) {
        console.log(values);
        axios
            .post("/api/feedback/create-feedback", form.getValues(), {
                headers: {
                    Accept: "application/json",
                },
            })
            .then((response) => {
                console.log(response.data);
                form.reset();
                setShowAlert(true);
            })
            .catch((err) => {
                console.error(err);
            });
    }

    const formFields = [
        {
            name: "name" as const,
            placeholder: "Ваше имя",
        },
        {
            name: "email" as const,
            placeholder: "Адрес электронной почты",
        },
        {
            name: "message" as const,
            placeholder: "Ваше сообщение",
            className: "min-h-[10em]",
        },
    ];

    return (
        <div className="dark:bg-transparent light:text-black dark:text-white flex flex-col justify-center py-10 w-screen min-h-screen">
            <Header title="Свяжитесь с нами" id="contactus" />
            <div className=" flex flex-col justify-center items-center">
                <Form {...form}>
                    <FormDescription>
                        Оставьте Ваш отзыв или коммерческое предложение
                    </FormDescription>
                    <form
                        onSubmit={form.handleSubmit(onSubmit)}
                        className="flex flex-col gap-4 mt-16 px-10 lg:mt-20 min-w-full lg:min-w-[500px]"
                    >
                        {formFields.map((field, index) => (
                            <FormField
                                key={index}
                                control={form.control}
                                name={field.name}
                                render={({ field: renderProps }) => (
                                    <FormItem>
                                        <FormControl>
                                            {field.name === "message" ? (
                                                <Textarea
                                                    placeholder={
                                                        field.placeholder
                                                    }
                                                    className={field.className}
                                                    {...renderProps}
                                                />
                                            ) : (
                                                <Input
                                                    {...field}
                                                    placeholder={
                                                        field.placeholder
                                                    }
                                                    {...renderProps}
                                                />
                                            )}
                                        </FormControl>
                                        <FormMessage />
                                    </FormItem>
                                )}
                            />
                        ))}
                        <div className="text-center mt-10">
                            <Button
                                className="px-8 py-2 border-black text-black bg-white hover:bg-black hover:text-white rounded-3xl"
                                variant="outline"
                                type="submit"
                            >
                                Отправить
                            </Button>
                        </div>
                    </form>
                </Form>
            </div>
        </div>
    );
};

export default ContactUs;
