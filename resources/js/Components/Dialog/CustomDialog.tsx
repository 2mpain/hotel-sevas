import { Button } from "@/Components/readyToUse/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/readyToUse/dialog";
import { Input } from "@/Components/readyToUse/input";
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

interface CustomDialogProps {
    onFormSubmit: (form: any) => void;
}

export function CustomDialog({ onFormSubmit }: CustomDialogProps) {
    const [open, setOpen] = useState(false);
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
                message: "Фамилия должна быть заполнена.",
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
        setOpen(false);
        onFormSubmit(form);
    }

    return (
        <>
            <Dialog open={open} onOpenChange={setOpen}>
                <DialogTrigger asChild>
                    <Button
                        className="my-5 border-black text-black bg-white hover:bg-black hover:text-white"
                        variant="outline"
                    >
                        Забронировать
                    </Button>
                </DialogTrigger>

                <DialogContent className="sm:max-w-[425px]">
                    <Form {...form}>
                        <form
                            onSubmit={form.handleSubmit(onSubmit)}
                            className="space-y-6"
                        >
                            <DialogHeader>
                                <DialogTitle>Бронь номера</DialogTitle>
                                <DialogDescription>
                                    Заполните свои контактные данные и нажмите
                                    на кнопку "Отправить".
                                </DialogDescription>
                            </DialogHeader>
                            <FormField
                                control={form.control}
                                name="first_name"
                                render={({ field }) => (
                                    <FormItem>
                                        <FormLabel>Имя</FormLabel>
                                        <FormControl>
                                            <Input
                                                placeholder="Сурен"
                                                {...field}
                                            />
                                        </FormControl>
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
                                    Убедитесь в корректности заполненных данных
                                    и ожидайте обратной связи.
                                </DialogDescription>

                                <Button
                                    className="border-black text-black bg-white hover:bg-black hover:text-white"
                                    variant="outline"
                                    type="submit"
                                >
                                    Отправить
                                </Button>
                            </DialogFooter>
                        </form>
                    </Form>
                </DialogContent>
            </Dialog>
        </>
    );
}
