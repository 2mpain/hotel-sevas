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
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/Components/readyToUse/form";
import { Input } from "@/Components/readyToUse/input";
import { zodResolver } from "@hookform/resolvers/zod";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { z } from "zod";

interface CustomDialogProps {
    onFormSubmit: (form: any) => void;
}

export function CustomDialog({ onFormSubmit }: CustomDialogProps) {
    const [open, setOpen] = useState(false);
    const phoneRegex = new RegExp(
        /^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$/
    );

    const formSchema = z.object({
        firstName: z
            .string()
            .min(2, {
                message: "Имя должно быть заполнено",
            })
            .max(20, {
                message: "Убедитесь в правильности ввода Имени.",
            }),
        lastName: z
            .string()
            .min(3, {
                message: "Фамилия должна быть заполнена.",
            })
            .max(20, {
                message: "Убедитесь в правильности ввода Фамилии.",
            }),
        middleName: z.string().optional(),
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
            firstName: "",
            lastName: "",
            middleName: "",
            email: "",
            phoneNumber: "",
        },
    });

    function onSubmit(values: z.infer<typeof formSchema>) {
        console.log(values);
        onFormSubmit(form);
        setOpen(false);
        form.reset();
    }

    const formFields = [
        {
            name: "firstName" as const,
            label: "Имя",
            placeholder: "Иван",
        },
        {
            name: "lastName" as const,
            label: "Фамилия",
            placeholder: "Иванов",
        },
        {
            name: "middleName" as const,
            label: "Отчество",
            placeholder: "Иванович",
        },
        {
            name: "email" as const,
            label: "E-mail",
            placeholder: "ivanov@gmail.com",
        },
        {
            name: "phoneNumber" as const,
            label: "Номер телефона",
            placeholder: "+79784335345",
        },
    ];

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
                            {formFields.map((field) => (
                                <FormField
                                    key={field.name}
                                    control={form.control}
                                    name={field.name}
                                    render={({ field: renderProps }) => (
                                        <FormItem>
                                            <FormLabel>{field.label}</FormLabel>
                                            <FormControl>
                                                <Input
                                                    placeholder={
                                                        field.placeholder
                                                    }
                                                    {...renderProps}
                                                />
                                            </FormControl>
                                            <FormMessage />
                                        </FormItem>
                                    )}
                                />
                            ))}
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
