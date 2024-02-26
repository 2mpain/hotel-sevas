import React from "react";
import { Header } from "@/Components/Header";
import { Button } from "@/Components/readyToUse/button";

const ContactUs: React.FC = () => {
  return (
    <div className="dark:bg-transparent light:text-black dark:text-white flex flex-col justify-center py-10 w-screen min-h-screen">
      <Header title="Свяжитесь с нами" id="contactus" />
      <div className=" flex flex-col justify-center items-center">
        <form className="flex flex-col gap-4 mt-16 px-10 lg:mt-20 min-w-full lg:min-w-[500px]">
          <input
            id="companyName"
            name="companyName"
            required
            maxLength={128}
            type="text"
            placeholder="Ваше имя"
            className="bg-gray-300 text-gray-900 outline-none border-2 border-white rounded-3xl px-8 py-2"
          />
          <input
            id="email"
            name="email"
            type="email"
            required
            maxLength={128}
            placeholder="Ваша почта"
            className="bg-gray-300 text-gray-900 outline-none border-2 border-white rounded-3xl px-8 py-2"
          />
          <textarea
            id="message"
            name="message"
            required
            maxLength={12334234}
            placeholder="Чем можем Вам помочь?"
            className="bg-gray-300 text-gray-900 outline-none border-2 border-white rounded-3xl px-8 py-6 min-h-[16em]"
          />
          <div className="text-center mt-10">
            <Button
              className="px-8 py-2 border-black text-black bg-white hover:bg-black hover:text-white rounded-3xl"
              variant="outline"
            >
              Отправить
            </Button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default ContactUs;
