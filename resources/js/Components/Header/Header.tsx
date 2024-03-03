import { motion } from "framer-motion";
import HeaderTitle from "./header-title";
import DrawerComp from "../readyToUse/drawer";
import { animate } from "@/utils/animate";
import { ModeToggle } from "@/Components/readyToUse/mode-toggle";

export default function Header() {
  return (
    <motion.div
      initial="hidden"
      whileInView="visible"
      className="backdrop-blur-xl flex z-10 w-full fixed top-0 rounded-b-md border border-gray-600 items-center p-1 px-3  shadow-lg flex-1 flex-row justify-between"
    >
      <motion.div custom={1} variants={animate(100, 0)}>
        <DrawerComp />
      </motion.div>
      <div className="flex-grow text-center">
        <motion.p
          custom={2}
          variants={animate(0, -100)}
          className="scroll-m-20 text-xl font-semibold tracking-tight"
        >
          Отель в Севастополе
        </motion.p>
        <HeaderTitle strings={["ул. Кронштадтская, 41", "+797812345678"]} />
      </div>

      <ModeToggle />
    </motion.div>
  );
}
