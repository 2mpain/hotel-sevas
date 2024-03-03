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
import { Label } from "@/Components/readyToUse/label";

export function CustomDialog() {
    return (
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
                        Заполните свои контактные данные и нажмите на кнопку
                        "Отправить".
                    </DialogDescription>
                </DialogHeader>
                <div className="grid gap-4 py-4">
                    <div className="grid grid-cols-4 items-center gap-4">
                        <Label htmlFor="first_name" className="text-right">
                            Ваше имя
                        </Label>
                        <Input
                            type="text"
                            id="name"
                            placeholder="Иван"
                            className="col-span-3"
                            minLength={2}
                            maxLength={18}
                        />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                        <Label htmlFor="last_name" className="text-right">
                            Фамилия
                        </Label>
                        <Input
                            type="text"
                            id="name"
                            placeholder="Иванов"
                            className="col-span-3"
                            minLength={2}
                            maxLength={24}
                            required
                        />
                    </div>

                    <div className="grid grid-cols-4 items-center gap-4">
                        <Label htmlFor="middle_name" className="text-right">
                            Отчество
                        </Label>
                        <Input
                            type="text"
                            id="name"
                            placeholder="Иванович"
                            className="col-span-3"
                            minLength={5}
                            maxLength={24}
                            required
                        />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                        <Label htmlFor="email" className="text-right">
                            Эл. почта
                        </Label>
                        <Input
                            type="email"
                            id="email"
                            placeholder="ivanov@gmail.com"
                            className="col-span-3"
                            required
                        />
                    </div>
                    <div className="grid grid-cols-4 items-center gap-4">
                        <Label htmlFor="phoneNumber" className="text-right">
                            Контактный номер
                        </Label>
                        <Input
                            type="tel"
                            id="tel"
                            placeholder="+79787812345"
                            className="col-span-3"
                            required
                        />
                    </div>
                </div>
                <DialogFooter>
                    <Button
                        className="border-black text-black bg-white hover:bg-black hover:text-white"
                        variant="outline"
                        type="submit"
                    >
                        Отправить
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    );
}
