import { ModeToggle } from "@/Components/readyToUse/mode-toggle";
import { animate } from "@/utils/animate";
import { motion } from "framer-motion";
import DrawerComp from "../readyToUse/drawer";
import HeaderTitle from "./header-title";

export default function Header() {
    return (
        <div
            className="backdrop-blur-xl flex z-10 w-full fixed top-0 rounded-b-md border border-gray-600 items-center p-1 px-3  shadow-lg flex-1 flex-row justify-between"
        >
            <div>
                <DrawerComp />
            </div>
            <div className="flex-grow text-center">
                <p
                    className="scroll-m-20 text-xl font-semibold tracking-tight"
                >
                    Отель в Севастополе
                </p>
                <HeaderTitle
                    strings={["ул. Кронштадтская, 41", "+797812345678"]}
                />
            </div>
            <ModeToggle />
        </div>
    );
}
