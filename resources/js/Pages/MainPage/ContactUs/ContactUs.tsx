import React from "react";
import { Header } from "@/Components/Header";
import { Button } from "@/Components/readyToUse/button";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormMessage,
} from "@/Components/readyToUse/form";
import { z } from "zod";
import { router } from "@inertiajs/react";
import { Input } from "@/Components/readyToUse/input";
import { Textarea } from "@/Components/readyToUse/textarea";


interface ContactUsProps{
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
        router.post("/feedbacks", form.getValues());
        form.reset();
        setShowAlert(true);
    }

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
                        <FormField
                            control={form.control}
                            name="name"
                            render={({ field }) => (
                                <FormItem>
                                    <FormControl>
                                        <Input
                                            {...field}
                                            placeholder="Ваше имя"
                                        />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="email"
                            render={({ field }) => (
                                <FormItem>
                                    <FormControl>
                                        <Input
                                            {...field}
                                            placeholder="Адрес электронной почты"
                                        />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="message"
                            render={({ field }) => (
                                <FormItem>
                                    <FormControl>
                                        <Textarea
                                            {...field}
                                            placeholder="Ваше сообщение ..."
                                            className="min-h-[10em]"
                                        />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
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
