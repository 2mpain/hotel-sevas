import { Button } from "@/Components/readyToUse/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
    DialogClose,
} from "@/Components/readyToUse/dialog";
import { Input } from "@/Components/readyToUse/input";
import { Label } from "@/Components/readyToUse/label";
import { router } from "@inertiajs/react";
import { useState } from "react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import { z } from "zod";
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/Components/readyToUse/form";

export function CustomDialog() {
    const phoneRegex = new RegExp(
        /^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$/
    );

    const formSchema = z.object({
        first_name: z
            .string()
            .min(2, {
                message: "Имя должно быть заполнено",
            })
            .max(20, {
                message: "Убедитесь в правильности ввода Имени.",
            }),
        last_name: z
            .string()
            .min(3, {
                message: "Фамилия должна быть не менее 3 букв.",
            })
            .max(20, {
                message: "Убедитесь в правильности ввода Фамилии.",
            }),
        middle_name: z.string().optional(),
        email: z
            .string()
            .min(1, { message: "Поле E-mail должно быть заполнено." })
            .email("E-mail введён некорректно"),
        phoneNumber: z
            .string()
            .min(12, { message: "Номер телефона введён некорректно." })
            .max(12, { message: "Номер телефона введён некорректно." })
            .refine((phone) => phoneRegex.test(phone), {
                message: "Номер телефона введён некорректно.",
            }),
    });

    const form = useForm<z.infer<typeof formSchema>>({
        resolver: zodResolver(formSchema),
        defaultValues: {
            first_name: "",
            last_name: "",
            middle_name: "",
            email: "",
            phoneNumber: "",
        },
    });

    function onSubmit(values: z.infer<typeof formSchema>) {
        console.log(values);
        router.post("/customers", form.getValues());
    }

    const [isOpen, setIsOpen] = useState(false);

    return (
        <Form {...form}>
            <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8">
                <Dialog>
                    <DialogTrigger asChild>
                        <Button
                            className="my-5 border-black text-black bg-white hover:bg-black hover:text-white"
                            variant="outline"
                        >
                            Забронировать
                        </Button>
                    </DialogTrigger>

                    <DialogContent className="sm:max-w-[425px]">
                        <DialogHeader>
                            <DialogTitle>Бронь номера</DialogTitle>
                            <DialogDescription>
                                Заполните свои контактные данные и нажмите на
                                кнопку "Отправить".
                            </DialogDescription>
                        </DialogHeader>
                        <FormField
                            control={form.control}
                            name="first_name"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Имя</FormLabel>
                                    <FormControl>
                                        <Input placeholder="Сурен" {...field} />
                                    </FormControl>
                                    <FormDescription>
                                        Укажите Ваше имя.
                                    </FormDescription>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="last_name"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Фамилия</FormLabel>
                                    <FormControl>
                                        <Input
                                            placeholder="Аракелян"
                                            {...field}
                                        />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <FormField
                            control={form.control}
                            name="middle_name"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Отчество</FormLabel>
                                    <FormControl>
                                        <Input
                                            placeholder="Свэгович"
                                            {...field}
                                        />
                                    </FormControl>
                                    <FormDescription>
                                        Пропустите данный пункт при отсутствии
                                        Отчества.
                                    </FormDescription>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <FormField
                            control={form.control}
                            name="email"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>E-mail</FormLabel>
                                    <FormControl>
                                        <Input
                                            placeholder="ivanov@gmail.com"
                                            {...field}
                                        />
                                    </FormControl>
                                    <FormDescription>
                                        Укажите Ваш основной электронный адрес.
                                    </FormDescription>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <FormField
                            control={form.control}
                            name="phoneNumber"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Номер телефона</FormLabel>
                                    <FormControl>
                                        <Input
                                            placeholder="+79784335345"
                                            {...field}
                                        />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <DialogFooter>
                            <DialogDescription>
                                Убедитесь в корректности заполненных данных и
                                ожидайте обратной связи.
                            </DialogDescription>

                            <Button
                                className="border-black text-black bg-white hover:bg-black hover:text-white"
                                variant="outline"
                                type="submit"
                                onClick={form.handleSubmit(onSubmit)}
                            >
                                Отправить
                            </Button>
                        </DialogFooter>
                    </DialogContent>
                </Dialog>
            </form>
        </Form>
    );
}
